<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewerCtl extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// navbartemp();

		$session_data = $this->session->userdata('logged_in');
		if (!$session_data) {
			redirect('welcome');
		}
		if ($session_data['nama_grup'] != 'reviewer') {
			redirect('AccountCtl/redirecting');
		}
	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function viewAssignment()
	{
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		$assignment = $this->Task->getAssignedTask($session_data['id_on_grup'], 0);
		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/view_assignment', array('assignment' => $assignment));
		$this->load->view('common/footer');
	}

	public function viewAcceptedAssignment()
	{
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		$assignment = $this->Task->getAssignedTask($session_data['id_on_grup'], 1);
		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/view_accepted_assignment', array('assignment' => $assignment));
		$this->load->view('common/footer');
	}

	public function viewRejectedAssignment()
	{
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		$assignment = $this->Task->getAssignedTask($session_data['id_on_grup'], -1);
		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/view_rejected_assignment', array('assignment' => $assignment));
		$this->load->view('common/footer');
	}

	public function viewCompletedAssignment()
	{
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		// last argument itu buat nentuin yang completed
		$assignment = $this->Task->getAssignedTask($session_data['id_on_grup'], 2);
		$assignmentPaid = $this->Task->getAssignedTask($session_data['id_on_grup'], 3);

		foreach ($assignmentPaid as $item) {
			array_push($assignment, $item);
		}

		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/view_completed_assignment', array('assignment' => $assignment));
		$this->load->view('common/footer');
	}

	public function acceptTask()
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$id_assignment = $this->uri->segment(3);
		$assignment = $this->Task->getAssignmentByID($id_assignment);
		$task = $this->Task->getTheTask($assignment[0]['id_task']);

		//update 1 = accept
		$result = $this->Reviewer->acceptAssignment($id_assignment, $task[0]['jumlah_hal']);
		$assignment = $this->Task->getAssignmentByID($id_assignment);


		// jika reviewer mengganti assignment milik reviewer lain
		if ($result == -1) {
			echo "INVALID ARGUMENTS! ";
			echo "NO ROW AFFECTED";
			return;
		}

		$this->session->set_flashdata(
			'assignsuccess',
			'<div class="alert alert-success" role="alert">
				You have successfully accepted <strong>' . $assignment[0]["judul"] . '</strong>..
				<a href="undoTask/' . $assignment[0]['id_assignment'] . '">undo?</a></div>'
		);
		redirect('reviewerctl/viewassignment');
	}

	public function rejectTask()
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$id_assignment = $this->uri->segment(3);

		//update 1 = accept
		$result = $this->Reviewer->updateThisAssignment($id_assignment, -1);
		$assignment = $this->Task->getAssignmentByID($id_assignment);

		// jika reviewer mengganti assignment milik reviewer lain
		if ($result == -1) {
			echo "INVALID ARGUMENTS! ";
			echo "NO ROW AFFECTED";
			return;
		}

		$this->session->set_flashdata(
			'assignsuccess',
			'<div class="alert alert-danger" role="alert">
				You have successfully rejected <strong>' . $assignment[0]["judul"] . '</strong>..
				<a href="undoTask/' . $assignment[0]['id_assignment'] . '">undo?</a></div>'
		);
		redirect('reviewerctl/viewassignment');
	}

	public function undoTask($id_assignment = -1)
	{
		$this->load->model('Reviewer');
		$result = $this->Reviewer->updateThisAssignment($id_assignment, 0);

		// jika reviewer mengganti assignment milik reviewer lain
		if ($result == -1) {
			echo "INVALID ARGUMENTS! ";
			echo "NO ROW AFFECTED";
			return;
		}
		redirect('reviewerctl/viewassignment');
	}

	public function submitReview($id_assignment = -1)
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$session_data = $this->session->userdata('logged_in');

		$id_assignment = $this->uri->segment(3);
		$assignment = $this->Task->getAssignmentByID($id_assignment);

		//cek udah di acc atau belum
		if ($assignment[0]['status'] != 1) {
			echo "INVALID ARGUMENTS! ";
			echo "ASSIGNMENT STATUS IS NOT ACCEPTED";
			return;
		}

		$task = $this->Task->getTheTask($assignment[0]['id_task']);

		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/submit_review', array('error' => "", 'task' => $task, 'id_assignment' => $id_assignment));
		$this->load->view('common/footer');
	}

	public function submittingReview($id_assignment = -1)
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$session_data = $this->session->userdata('logged_in');

		$id_assignment = $this->uri->segment(3);
		$assignment = $this->Task->getAssignmentByID($id_assignment);

		//cek udah di acc atau belum
		if ($assignment[0]['status'] != 1) {
			echo "INVALID ARGUMENTS! ";
			echo "ASSIGNMENT STATUS IS NOT ACCEPTED";
			return;
		}

		$task = $this->Task->getTheTask($assignment[0]['id_task']);

		$config['upload_path']          = '../../ereview/berkas-review/';
		$config['allowed_types']        = 'docx|doc|pdf';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time() . '_' . $session_data['nama'] . '_' . $task[0]['judul']);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		//gagap upload
		if (!$this->upload->do_upload('userfile')) {
			$error = $this->upload->display_errors();

			$this->load->view('common/header_reviewer', array("session_data" => $session_data));
			$this->load->view('reviewer/submit_review', array('error' => $error, 'task' => $task, 'id_assignment' => $id_assignment));
			$this->load->view('common/footer');
			return;
		}

		$data = array('upload_data' => $this->upload->data());

		$this->session->set_userdata('review_location', $new_name);
		// echo "hasil loc: ".$this->session->userdata('review_location');
		// return;
		#-- update assignment status
		$submit_return = $this->Reviewer->updateThisAssignment($id_assignment, 2);
		if ($submit_return == -1) {
			echo 'INVALID ARGUMENTS! ';
			echo 'ASSIGNMENT ERROR';
			return;
		}


		$this->load->view('common/header_reviewer', array("session_data" => $session_data));
		$this->load->view('reviewer/submit_review_success', array('error' => "", 'task' => $task));
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

	public function debug()
	{
		$id_reviewer = $this->session->userdata('logged_in')['id_on_grup'];
		echo $id_reviewer;
	}
}
