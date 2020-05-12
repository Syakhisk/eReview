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

	public function completedTask(){
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');

		$tasks = $this->Task->getAssignedTaskMakelaar(4);

		
		$this->load->view('common/header_makelaar', array("session_data" => $session_data));
		$this->load->view('makelaar/view_completed_task', array('tasks' => $tasks));
		$this->load->view('common/footer');
		
	}

	public function downloadTask($id_assignment)
	{
		$this->load->helper('download');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$id_assignment = base64_decode($this->uri->segment(3));
		$assignment = $this->Task->getAssignmentByID($id_assignment);
		$task = $this->Task->getTheTask($assignment[0]['id_task']);
		// var_dump($task);

		force_download('../../ereview/berkas/' . $task[0]['filelocation'], NULL);
	}

	public function downloadReview($review_location)
	{
		$this->load->helper('download');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$review_location = base64_decode($this->uri->segment(3));
		echo $review_location;

		force_download('../../ereview/berkas-review/' . $review_location, NULL);
		// force_download('../../ereview/berkas-review/test.txt', NULL);
	}

	public function confirmTaskCompletion($id_assignment = -1){
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$session_data = $this->session->userdata('logged_in');

		
		$id_assignment = base64_decode($this->uri->segment(3));
		// var_dump($id_assignment);
		// return;
		$task = $this->Task->updateThisAssignment($id_assignment, 4);

		return;
	}

	public function rejectTaskCompletion($id_assignment = -1){
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$session_data = $this->session->userdata('logged_in');

		
		$id_assignment = base64_decode($this->uri->segment(3));
		// var_dump($id_assignment);
		// return;
		$task = $this->Task->updateThisAssignment($id_assignment, 2);

		return;
	}
}
