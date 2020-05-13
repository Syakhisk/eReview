<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PaymentCtl extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    navbartemp();

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
    
    $this->Payment->doTopUp();
    $msg = "You have successfully requested a top up!";

    $this->load->view('common/header_' . $session_data['nama_grup'], array("session_data" => $session_data));
    $this->load->view('topup_form', array('error' => [], 'msg' => $msg, 'session_data' => $session_data));
    $this->load->view('common/footer');
  }

  public function topupConfirmation(){
    $this->load->model('Payment');
    
  }
}
