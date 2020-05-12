<?php
defined('BASEPATH') or exit('No direct script access allowed');

class EditorCtl extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// navbartemp();

		$session_data = $this->session->userdata('logged_in');
		if (!$session_data) {
			redirect('welcome');
		}
		if ($session_data['nama_grup'] != 'editor') {
			redirect('AccountCtl/redirecting');
		}
	}

	public function index()
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('common/topmenu');
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function viewTask()
	{
		// sts_task value:
		// 0 = inactive (finished)
		// 1 = unassigned
		// 2 = assigned

		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		$tasks = $this->Task->getAllTask($session_data['id_on_grup']);
		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/view_task', array('tasks' => $tasks));
		$this->load->view('common/footer');
	}

	public function viewAssignedTask()
	{
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		$assignment = $this->Task->getMyAssignedTask();
		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/view_assigned_task', array('assignment' => $assignment));
		$this->load->view('common/footer');
	}

	public function addTask()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}
		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/add_task', array('error' => "",));
		$this->load->view('common/footer');
	}

	public function addingTask()
	{
		$this->load->model('Task');

		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/index');
		}

		$session_data = $this->session->userdata('logged_in');

		if ($session_data['nama_grup'] != 'editor') {
			redirect('welcome/redirecting');
		}

		$this->form_validation->set_rules(
			'judul',
			'Title',
			'trim|min_length[2]|max_length[250]|xss_clean|required'
		);
		$this->form_validation->set_rules(
			'katakunci',
			'Keywords',
			'trim|min_length[2]|max_length[128]|xss_clean|required'
		);
		$this->form_validation->set_rules(
			'authors',
			'Authors',
			'trim|min_length[2]|max_length[256]|xss_clean|required'
		);
		$this->form_validation->set_rules(
			'halaman',
			'Pages',
			'trim|min_length[1]|max_length[128]|xss_clean|numeric'
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header_editor', array("session_data" => $session_data));
			$this->load->view('editor/add_task', array('error' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$config['upload_path']          = '../../ereview/berkas/';
		$config['allowed_types']        = 'docx|doc|pdf';
		$config['max_size']             = 10000;

		$new_name = str_replace(' ', '_', time() . '_' . $_FILES["userfile"]['name']);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('userfile')) {
			$error = array('error' => $this->upload->display_errors());
			$this->load->view('common/header_editor', array("session_data" => $session_data));
			$this->load->view('editor/add_task', $error);
			$this->load->view('common/footer');
			return;
		}
		$data = array('upload_data' => $this->upload->data());
		$id_task = $this->Task->insertNewTask($session_data['id_on_grup'], $new_name);

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/add_task_success', array('error' => ""));
		$this->load->view('common/footer');
		return;
	}

	public function selectPotentialReviewer($msg = '')
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		// $tasks = $this->Task->getAllTask($session_data['id_user']);
		$tasks = $this->Task->getAllTask($session_data['id_on_grup']);
		$reviewers = $this->Reviewer->getAllReviewers();

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/select_potential_reviewer', array('msg' => $msg, 'tasks' => $tasks, 'reviewers' => $reviewers));
		$this->load->view('common/footer');
	}

	public function selectingPotentialReviewer()
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$this->form_validation->set_rules(
			'article',
			'Article',
			'required|min_length[1]'
		);

		$this->form_validation->set_rules(
			'reviewers[]',
			'Reviewers',
			'required'
		);

		// get task
		// $tasks = $this->Task->getAllTask($session_data['id_user']);
		$tasks = $this->Task->getAllTask($session_data['id_on_grup']);
		$reviewers = $this->Reviewer->getAllReviewers();

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header_editor', array("session_data" => $session_data));
			$this->load->view('editor/select_potential_reviewer', array('msg' => $msg, 'tasks' => $tasks, 'reviewers' => $reviewers));
			$this->load->view('common/footer');
			return FALSE;
		}

		$task = array("article" => $this->input->post('article'), "reviewers" => $this->input->post('reviewers'));
		$this->session->set_flashdata('selected', $task);

		// print_r($this->session->flashdata('selected'));
		// return;
		redirect('editorctl/submitReviewer');
	}

	public function submitReviewer($msg = '')
	{
		$session_data = $this->session->userdata('logged_in');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$selected = $this->session->flashdata('selected');

		if (!$selected) {
			echo 'Select the article and reviewers first!';
			echo '<br>';
			echo 'click <a href="';
			echo base_url('editorctl/selectpotentialreviewer');
			echo '">here</a> to go back';

			return;
		}

		$selected_reviewers = [];

		foreach ($selected['reviewers'] as $rev) {
			$reviewer = $this->Reviewer->getReviewerByID($rev);
			$selected_reviewers[$reviewer[0]['id_reviewer']] = $reviewer[0]['nama'];
		}

		$article = $this->Task->getTheTask($selected['article']);

		$data = array('msg' => $msg, 'article' => $article, 'reviewers' => $selected_reviewers);

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/submit_reviewer', $data);
		$this->load->view('common/footer');
	}

	public function submittingReviewer()
	{

		// assignment status:
		// -2 = accepted by other (opt)
		// -1 = rejected
		// 0 = assigned but not accepted
		// 1 = assigned and accepted
		// 2 = submitted result but not paid
		// 3 = paid

		$this->load->model('Reviewer');
		$this->load->model('Task');

		$article = $this->input->post('article');
		$reviewers = $this->input->post('reviewers');

		// var_dump($article, $reviewers);
		$assignments_id = [];

		foreach ($reviewers as $item) {
			array_push(
				$assignments_id,
				$this->Task->assignTaskTo($item, $article)
			);
		}

		// var_dump($assignments_id);
		// return;

		# -- display
		$assigned_reviewers = [];
		foreach ($assignments_id as $item) {
			$assignment = $this->Task->getAssignmentByID($item);
			// var_dump($assignment);
			// return;
			$assigned_task = $assignment[0]['judul'];
			array_push($assigned_reviewers, $assignment[0]['nama']);
		}

		$session_data = $this->session->userdata('logged_in');

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/submit_success', array('judul' => $assigned_task, 'reviewers' => $assigned_reviewers));
		$this->load->view('common/footer');
	}

	public function commitPayment($payment_status = -1)
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$session_data = $this->session->userdata('logged_in');
		$data = [];

		if ($payment_status != 2 && $payment_status != 3 && $payment_status != 4) {
			redirect('editorctl/commitpayment/2');
		}

		$article = $this->Task->getMyAssignedTaskByStatus($payment_status);
		$assignment = [];


		$session_data = $this->session->userdata('logged_in');
		$msg = "";
		// var_dump($assignment);
		// return;

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/commit_payment', array(
			'assignment' => $assignment,
			'article' => $article,
			'msg' => $msg,
			'form' => null,
			'selected' => ""
		));
		$this->load->view('common/footer');
	}

	public function commitPayment2($id_assignment = 0)
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$session_data = $this->session->userdata('logged_in');


		$payment_status = 2;
		$assignments = $this->Task->getMyAssignedTaskByStatus($payment_status);

		if ($id_assignment != 0) {
			$selected_assignment = $this->Task->getAssignmentByID($id_assignment)[0];
		} else {
			$selected_assignment = [];
		}
		// var_dump($selected_assignment);
		// return;

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/payment_form', array(
			'assignments' => $assignments,
			'selected_id' => $id_assignment,
			'selected' => $selected_assignment,
			'error' => []
		));
		$this->load->view('common/footer');
	}

	public function updatepaymentform($payment_status = -1)
	{
		$this->load->model('Reviewer');
		$this->load->model('Task');

		$id_assignment = $this->input->post('assignment');

		$session_data = $this->session->userdata('logged_in');
		$assignment = $this->Task->getAssignmentByID($id_assignment);
		$article = $this->Task->getMyAssignedTaskByStatus($payment_status);

		$this->form_validation->set_rules(
			'assignment',
			'Assignment',
			'xss_clean|required'
		);
		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header_editor', array("session_data" => $session_data));
			$this->load->view('editor/commit_payment', array(
				'assignment' => $assignment,
				'article' => $article,
				'msg' => $msg,
				'form' => [],
				'selected' => []
			));
			$this->load->view('common/footer');

			return FALSE;
		}

		$form = array(
			"assignment" => $this->input->post('assignment'),
			"halaman" => $assignment[0]['jumlah_hal'],
			"amount" => $assignment[0]['jumlah_hal'] * 100
		);

		$session_data = $this->session->userdata('logged_in');
		$msg = "";

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/commit_payment', array(
			'assignment' => $assignment,
			'article' => $article,
			'msg' => $msg,
			'form' => $form,
			'selected' => $this->input->post('assignment')
		));
		$this->load->view('common/footer');
	}

	public function commitThisPayment($id_assignment = -1)
	{
		$this->load->model('Reviewer');
		$this->load->model('Task');
		$session_data = $this->session->userdata('logged_in');

		#update model
		$value = 3; //editor udah siap bayar tinggal di confirm makelaar
		$this->Task->updateThisAssignment($id_assignment, $value);
		$assignment = $this->Task->getAssignmentByID($id_assignment);

		$judul = $assignment[0]['judul'];
		$reviewer = $assignment[0]['nama'];

		$this->load->view('common/header_editor', array("session_data" => $session_data));
		$this->load->view('editor/commit_payment_success', array('judul' => $judul, 'reviewer' => $reviewer));
		$this->load->view('common/footer');
	}

	public function downloadReview($review_location)
	{
		$this->load->helper('download');
		$this->load->model('Task');
		$this->load->model('Reviewer');

		$session_data = $this->session->userdata('logged_in');

		$review_location = base64_decode($this->uri->segment(3));
		// echo $review_location;

		force_download('../../ereview/berkas-review/' . $review_location, NULL);
		// force_download('../../ereview/berkas-review/test.txt', NULL);
	}
}
