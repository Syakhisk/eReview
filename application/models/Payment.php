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
    return;
  }

  function confirmTopUp()
  {
    $session_data = $this->session->userdata('logged_in');
    $id_grup = $session_data['id_grup'];
    $id_user = $session_data['id_user'];

    if ($id_grup == 1) {
      $id_editor = $session_data['id_on_grup'];

      $this->db->set('balance');
      $this->db->from('editor');
      $this->db->where('id_editor', $id_editor);
    } else if ($id_grup == 2) {
      $id_reviewer = $session_data['id_on_grup'];

      $this->db->set('balance');
      $this->db->from('reviewer');
      $this->db->where('id_reviewer', $id_reviewer);
    } else {
      //sebenernya makelaar gak ada balance
      $id_makelaar = $session_data['id_on_grup'];
    }
  }

  function Payment($id_assignment = -1, $id_editor = -1, $id_reviewer = -1, $amount = -1)
  {
    $q = "UPDATE editor 
            SET balance = balance - $amount
            WHERE id_editor = $id_editor;";
    $this->db->query($q);

    $q2 = "UPDATE reviewer 
            SET balance = balance + $amount
            WHERE id_reviewer = $id_reviewer;";
    $this->db->query($q2);
    
    $q3 = "INSERT INTO pembayaran (id_assignment, amount)
            VALUES ($id_assignment, $amount);";
    $this->db->query($q3);
  }
}
