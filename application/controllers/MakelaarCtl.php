<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MakelaarCtl extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		navbartemp();

		$session_data = $this->session->userdata('logged_in');
		
		if (!$session_data) {
			redirect('welcome');
		}
		if ($session_data['nama_grup'] != 'makelaar') {
			redirect('AccountCtl/redirecting');
		}

	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		
		$this->load->view('common/header_makelaar', array("session_data" => $session_data));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function newTask(){
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');

		$tasks = $this->Task->getAllTaskMakelaar();
		
		$this->load->view('common/header_makelaar', array("session_data" => $session_data));
		$this->load->view('makelaar/view_new_task', array('tasks' => $tasks));
		$this->load->view('common/footer');
		
	}

	public function onGoingTask(){
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');

		$tasks = $this->Task->getAssignedTaskMakelaar(0);
		
		$this->load->view('common/header_makelaar', array("session_data" => $session_data));
		$this->load->view('makelaar/view_ongoing_task', array('tasks' => $tasks));
		$this->load->view('common/footer');
		
	}

	public function awaitingConfirmationTask(){
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');

		$tasks = $this->Task->getAssignedTaskMakelaar(3);
		
		$this->load->view('common/header_makelaar', array("session_data" => $session_data));
		$this->load->view('makelaar/view_awaiting_task', array('tasks' => $tasks));
		$this->load->view('common/footer');
		
	}
}
