<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentCtl extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    // navbartemp();

    $session_data = $this->session->userdata('logged_in');

    if (!$session_data) {
      redirect('accountCtl/login');
    }
  }

  public function index()
  {
    redirect('paymentctl/topup');
  }

  public function topUp()
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $this->load->view('common/header_' . $session_data['nama_grup'], array("session_data" => $session_data));
    $this->load->view('topup_form', array('error' => [], 'msg' => "", 'session_data' => $session_data));
    $this->load->view('common/footer');
  }

  public function submitTopUp()
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $config['upload_path']          = '../../ereview/bukti/';
    $config['allowed_types']        = 'png|jpg|jpeg';
    $config['max_size']             = 5000;
    if ($_FILES["userfile"]["name"]) {
      $new_name = str_replace(' ', '_', 'buktipayment_' . time() . '_' . $session_data['nama'] . '.' . pathinfo($_FILES["userfile"]["name"])['extension']);
      $config['file_name'] = $new_name;
    }

    $this->load->library('upload', $config);

    //gagal upload
    if (!$this->upload->do_upload('userfile')) {
      $error = array('error' => $this->upload->display_errors());

      $this->load->view('common/header_' . $session_data['nama_grup'], array("session_data" => $session_data));
      $this->load->view('topup_form', array('error' => $error, 'msg' => "", 'session_data' => $session_data));
      $this->load->view('common/footer');
      return;
    }

    $data = array('upload_data' => $this->upload->data());

    $id_dana = $this->Payment->doTopUp();
    $msg = "You have successfully requested a top up with the ID: " . $id_dana;

    $this->load->view('common/header_' . $session_data['nama_grup'], array("session_data" => $session_data));
    $this->load->view('topup_form', array('error' => [], 'msg' => $msg, 'session_data' => $session_data));
    $this->load->view('common/footer');
  }

  public function topUpConfirmation($uri = NULL)
  {
    //status
    // 0 = pending
    // 1 = confirmed
    // -1 = rejected

    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    if ($uri == NULL && $uri != 2 && $uri != 3 && $uri != 4) redirect('paymentctl/topupconfirmation/3');
    $status = $uri - 3;
    $requests = $this->Payment->getTopUpByStatus($status);

    if ($uri == 3) $link = 'makelaar/pending_topup';
    else if ($uri == 4) $link = 'makelaar/confirmed_topup';
    else if ($uri == 2) $link = 'makelaar/rejected_topup';

    $this->load->view('common/header_makelaar', array('session_data' => $session_data));
    $this->load->view($link, array('requests' => $requests));
    $this->load->view('common/footer');
  }

  public function confirmTopUp($encoded_id_dana = -1)
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $id_dana = base64_decode($encoded_id_dana);
    $this->Payment->confirmThisTopUp($id_dana);

    $this->session->set_flashdata('topup_confirmed', 'You have sucessfully confirmed the top up with ID: ' . $id_dana);

    redirect('paymentctl/topupconfirmation/3');
  }

  public function rejectTopUp($encoded_id_dana = -1)
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $id_dana = base64_decode($encoded_id_dana);
    $this->session->set_flashdata('topup_rejected', 'You have sucessfully rejected the top up with ID: ' . $id_dana);

    $this->Payment->rejectThisTopUp($id_dana);
    redirect('paymentctl/topupconfirmation/3');
  }

  public function paymentConfirmation($uri = NULL)
  {
    //status
    // 0 = pending
    // 1 = confirmed
    // -1 = rejected

    $this->load->model('Payment');
    $this->load->model('Task');
    $session_data = $this->session->userdata('logged_in');

    if ($uri == NULL && $uri != 2 && $uri != 3 && $uri != 4) redirect('paymentctl/paymentconfirmation/3');
    
    $status = $uri - 3;
    $requests = $this->Payment->getPaymentByStatus($status);
    foreach($requests as $key=>$value){
      $assignment = $this->Task->getAssignmentByID($value['id_assignment']);
      $requests[$key]['judul'] = $assignment[0]['judul'];
      $requests[$key]['review_location'] = $assignment[0]['review_location'];
    }
   
    if ($uri == 3) $link = 'makelaar/pending_payment';
    else if ($uri == 4) $link = 'makelaar/confirmed_payment';
    else if ($uri == 2) $link = 'makelaar/rejected_payment';

    $this->load->view('common/header_makelaar', array('session_data' => $session_data));
    $this->load->view($link, array('requests' => $requests));
    $this->load->view('common/footer');
  }

  public function confirmPayment($encoded_id_pembayaran = -1)
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $id_pembayaran = base64_decode($encoded_id_pembayaran);
    $this->Payment->confirmThisPayment($id_pembayaran);

    $this->session->set_flashdata('payment_confirmed', 'You have sucessfully confirmed the payment with ID: ' . $id_pembayaran);

    redirect('paymentctl/paymentconfirmation/3');
  }

  public function rejectPayment($encoded_id_pembayaran = -1)
  {
    $this->load->model('Payment');
    $session_data = $this->session->userdata('logged_in');

    $id_pembayaran = base64_decode($encoded_id_pembayaran);
    $this->session->set_flashdata('payment_rejected', 'You have sucessfully rejected the payment with ID: ' . $id_pembayaran);

    $this->Payment->rejectThisPayment($id_pembayaran);
    redirect('paymentctl/paymentconfirmation/3');
  }
  
  public function downloadBukti($bukti_loc)
  {
    $this->load->helper('download');
    $this->load->model('Task');
    $this->load->model('Reviewer');

    $bukti_loc = base64_decode($this->uri->segment(3));
    // $topup = $this->Task->getTopUpByID($id_dana);

    force_download('../../ereview/bukti/' . $bukti_loc, NULL);
  }
}
