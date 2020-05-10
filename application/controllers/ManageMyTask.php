<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ManageMyTask extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		navbartemp();
	}

	public function index()
	{
		$this->load->view('templates/Header', array('judul_page' => 'ManageMyTask'));
		$this->load->view('welcome', array('judul_page' => 'ManageMyTask'));
		$this->load->view('templates/Footer');
	}

	//argumen '$pesan' dipake kalo butuh variabel dari luar
	public function addNewTask($pesan = '')
	{
		$this->load->model('Task');
		/* kalo pengen ada variabel yang di pass ke (view).php harus
			dikasih pointer didalem function pakai array 'key' => 'value'*/
		$this->load->view('templates/Header', array('judul_page' => 'ManageMyTask'));
		$this->load->view('editor/AddNewTask', array('msg' => $pesan));
		$this->load->view('templates/Footer');
	}

	public function addingNewTask()
	{
		/* function ini adalah function form validation, function ini
			hanya akan muncul ketika submit telah dipencet minimal 1 kali,
			isinya error message di line 37 ($msg) */
		$this->load->model('Task');
		$this->form_validation->set_rules(
			'judul', //form field name
			'Judul', //display
			'required|trim|min_length[2]|max_length[250]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'katakunci', //form field name
			'Kata Kunci', //display
			'required|trim|min_length[2]|max_length[50]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'authors', //form field name
			'Authors', //display
			'required|trim|min_length[2]|max_length[300]|xss_clean' //args
		);


		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			//key dalam array adalah nama variabel yang dipakai di view tujuan
			$this->load->view('templates/Header', array('judul_page' => 'ManageMyTask'));
			$this->load->view('editor/AddNewTask', array('msg' => $msg));
			$this->load->view('templates/Footer');
			return FALSE;
		}

		$id_task = $this->Task->insertNewTask();
		redirect('manageMyTask/selectPotentialReviewer/' . $id_task);
	}

	//intinya kalo mau ambil variabel dari func lain, 
	//masukin ke argumen function yang dituju dulu, contoh:
	public function selectPotentialReviewer($id_task = -1)
	{
		$this->load->model('Task');
		$this->load->model('Reviewer');
		$thetask = $this->Task->getTheTask($id_task);
		$reviewers = $this->Reviewer->getAllReviewers();
		$names = $this->Reviewer->getReviewersNames();

		$this->load->view('templates/Header', array('judul_page' => 'ManageMyTask'));
		//declare variabel untuk dipass ke view selectpotential reviewer
		$this->load->view(
			'editor/selectPotentialReviewer',
			array(
				'task' => $thetask[0],
				'reviewers' => $reviewers,
				'names' => $names
			)
		);
		$this->load->view('templates/Footer');
	}

	public function commitPayment()
	{
		$this->load->model('Payment');
		$this->load->view('templates/Header', array('judul_page' => 'ManageMyTask'));
		$this->load->view('editor/CommitPayment');
		$this->load->view('templates/Footer');
	}

	public function confirmTask()
	{
		$this->load->model('Task');
	}
}
