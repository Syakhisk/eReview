<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Payment extends CI_Model
{

  function getBalance()
  {
    $session_data = $this->session->userdata('logged_in');
    $id_grup = $session_data['id_grup'];

    $id_editor = NULL;
    $id_reviewer = NULL;
    $id_makelaar = NULL;

    if ($id_grup == 1) {
      $id_editor = $session_data['id_on_grup'];

      $this->db->select('balance');
      $this->db->from('editor');
      $this->db->where('id_editor', $id_editor);
    } else if ($id_grup == 2) {
      $id_reviewer = $session_data['id_on_grup'];

      $this->db->select('balance');
      $this->db->from('reviewer');
      $this->db->where('id_reviewer', $id_reviewer);
    } else {
      //sebenernya makelaar gak ada balance
      $id_makelaar = $session_data['id_on_grup'];
      return "";
    }

    $res = $this->db->get();
    $session_data['balance'] = $res->row()->balance;
    $this->session->set_userdata('logged_in', $session_data);
    return $res->row()->balance;
  }

  function doTopUp()
  {
    $session_data = $this->session->userdata('logged_in');
    $id_user = $session_data['id_user'];

    $data = array(
      'id_user' => $id_user,
      'amount' => $this->input->post('amount'),
      'bukti' => $this->upload->data('file_name')
    );

    $this->db->insert('dana', $data);
    return $this->db->insert_id();
  }

  function confirmThisTopUp($id_dana = -1)
  {

    $this->db->set('sts_dana', 1);
    $this->db->where('id_dana', $id_dana);
    $this->db->update('dana');

    $this->db->reset_query();

    $this->db->select('id_user, amount');
    $this->db->where('id_dana', $id_dana);
    $res = $this->db->get('dana')->result_array();

    $amount = $res[0]['amount'];
    $id_user = $res[0]['id_user'];

    $this->db->set('balance', 'balance + ' . $amount, FALSE);
    $this->db->where('id_user', $id_user);
    $this->db->update('editor');
  }

  function rejectThisTopUp($id_dana = -1)
  {

    $this->db->set('sts_dana', -1);
    $this->db->where('id_dana', $id_dana);
    $this->db->update('dana');

    $this->db->reset_query();
  }

  function getTopUpByStatus($status = -1)
  {
    $q = "SELECT d.*,u.nama,e.id_editor FROM dana d
          INNER JOIN users u ON u.id_user = d.id_user
          INNER JOIN editor e ON e.id_user = u.id_user
          WHERE d.sts_dana = $status";
    $res = $this->db->query($q);
    return $res->result_array();
  }

  function getTopUpByID($id_dana = -1)
  {
    $q = "SELECT d.*,u.nama,e.id_editor FROM dana d
          INNER JOIN users u ON u.id_user = d.id_user
          INNER JOIN editor e ON e.id_user = u.id_user
          WHERE d.id_dana = $id_dana";
    $res = $this->db->query($q);
    return $res->result_array();
  }

  function doPayment($id_assignment = -1, $id_editor = -1, $id_reviewer = -1, $amount = -1)
  {
    # update balance dilakukan makelaar
    $q = "UPDATE editor 
            SET balance = balance - $amount
            WHERE id_editor = $id_editor;";
    $this->db->query($q);

    // $q2 = "UPDATE reviewer 
    //         SET balance = balance + $amount
    //         WHERE id_reviewer = $id_reviewer;";
    // $this->db->query($q2);

    $q3 = "INSERT INTO pembayaran (id_assignment, id_editor, id_reviewer, amount)
            VALUES ($id_assignment, $id_editor, $id_reviewer, $amount);";
    $this->db->query($q3);
    return;
  }

  function getPaymentByAssignmentID($id_assignment = -1)
  {

    $q = "SELECT sts_pembayaran FROM pembayaran p
          WHERE id_assignment = $id_assignment";
          
    $res = $this->db->query($q);
    return $res->result_array();
  }

  function getPaymentByStatus($status = -1)
  {
    $q = "SELECT p.*,sq.nama_editor,sq2.nama_reviewer,sq2.id_reviewer FROM pembayaran p
          INNER JOIN (SELECT u.nama AS nama_editor, e.id_editor FROM editor e INNER JOIN users u ON e.id_user = u.id_user) sq
          ON p.id_editor = sq.id_editor
          INNER JOIN (SELECT u.nama AS nama_reviewer, r.id_reviewer FROM reviewer r INNER JOIN users u ON r.id_user = u.id_user) sq2
          ON p.id_reviewer = sq2.id_reviewer
          WHERE p.sts_pembayaran = $status";
    // echo $q;
    // return;
    $res = $this->db->query($q);
    return $res->result_array();
  }

  function confirmThisPayment($id_payment = -1)
  {
    #update status pembayaran
    $this->db->set('sts_pembayaran', 1);
    $this->db->where('id_pembayaran', $id_payment);
    $this->db->update('pembayaran');

    $this->db->reset_query();

    #ambil amount
    $this->db->select('id_reviewer, amount');
    $this->db->where('id_pembayaran', $id_payment);
    $res = $this->db->get('pembayaran')->result_array();

    $id_assignment = $res[0]['id_assignment'];
    $id_editor = $res[0]['id_editor'];
    $amount = $res[0]['amount'];
    $id_reviewer = $res[0]['id_reviewer'];

    $this->db->set('balance', 'balance + ' . $amount, FALSE);
    $this->db->where('id_reviewer', $id_reviewer);
    $this->db->update('reviewer');

    #update assignment status
    $this->db->set('status', 4);
    $this->db->where('id_assignment', $id_assignment);
    $res = $this->db->update('assignment2');
  }

  function rejectThisPayment($id_payment = -1)
  {

    $this->db->set('sts_pembayaran', -1);
    $this->db->where('id_payment', $id_payment);
    $this->db->update('pembayaran');

    $this->db->reset_query();

    #ambil amount
    $this->db->select('id_reviewer, amount');
    $this->db->where('id_pembayaran', $id_payment);
    $res = $this->db->get('pembayaran')->result_array();

    $amount = $res[0]['amount'];
    $id_task = $res[0]['id_task'];

    #ambil id_editor
    $this->db->select('id_editor');
    $this->db->where('id_task', $id_task);
    $res2 = $this->db->get('task');

    $id_editor = $res2[0]['id_editor'];

    $q = "UPDATE editor 
    SET balance = balance - $amount
    WHERE id_editor = $id_editor;";
    $this->db->query($q);
  }

  function deduct($id_reviewer = -1, $amount = -1){
    $q = "UPDATE reviewer r
          SET balance = balance - $amount
          WHERE id_reviewer = $id_reviewer;";
    $this->db->query($q);

    return;
    
  }
  
}
