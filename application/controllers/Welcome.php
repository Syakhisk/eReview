<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		// navbartemp();

		$session_data = $this->session->userdata('logged_in');

		if (!$session_data) {
			redirect('accountCtl/login');
		}

		switch ($session_data['id_grup']) {
			case '1':
				redirect('editorCtl/index/' . $session_data['id_user']);
				break;
			case '2':
				redirect('reviewerCtl/index/' . $session_data['id_user']);
				break;
			case '3':
				redirect('makelaarCtl/index/' . $session_data['id_user']);
				break;
			default:
				redirect('welcome');
				break;
		}
		
	}

	public function index()
	{	
		$this->load->view('common/header', array('judul_page' => 'eReview Home'));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}
}
