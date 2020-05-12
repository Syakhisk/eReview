<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountCtl extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		navbartemp();
	}

	public function index()
	{
		$this->load->view('common/header', array('judul_page' => 'AccountCtl'));
		$this->load->view('common/content');
		$this->load->view('common/footer');
	}

	public function signUp($pesan = NULL)
	{
		$judul = 'Register Page';

		$this->load->view('common/header', array('judul_page' => $judul));
		$this->load->view('signup', array('error' => $pesan));
		$this->load->view('common/footer');

		return;
	}

	public function signingUp($msg = '')
	{
		$judul = 'Register Page';
		$this->load->model('Account');
		// $this->load->library(array('file'));


		$this->form_validation->set_rules(
			'sandi', //form field name
			'Kata Sandi', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'username', //form field name
			'Username', //display
			'required|is_unique[users.username]|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'nama', //form field name
			'Nama', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'email', //form field name
			'Email', //display
			'required|valid_email|is_unique[users.email]|trim|min_length[2]|max_length[256]|xss_clean' //args
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();

			$this->load->view('common/header', array('judul_page' => $judul));
			$this->load->view('signup', array('error' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$config['upload_path']          = './photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 50;
		$config['max_width']            = 150;
		$config['max_height']           = 200;

		$new_name = str_replace(' ', '_', time() . '_' . $_FILES["photo"]['name']);
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) {
			// gagal upload
			$error = array('error' => $this->upload->display_errors());

			$this->load->view('common/header', array('judul_page' => $judul));
			$this->load->view('signup', $error);
			$this->load->view('common/footer');

			return;
		}
		$data = array('upload_data' => $this->upload->data());
		$users = $this->Account->insertNewUser();
		$this->load->view('common/header', array('judul_page' => $judul));
		$this->load->view('signup_success');
		$this->load->view('common/footer');
		return;
	}

	public function login($pesan = '')
	{
		$this->load->model('Account');

		if ($this->session->userdata('logged_in')) {
			if ($this->session->userdata('id_grup') == 1) {
				redirect('editorCtl/'); // welcome page editor
			} elseif ($this->session->userdata('id_grup') == 2) {
				redirect('reviewerCtl/'); // welcome page reviewer
			} elseif ($this->session->userdata('id_grup') == 3) {
				redirect('makelaarCtl/'); //welcome page makelaar
			}
		}

		$judul = 'Login Page';

		$this->load->view('common/header', array('judul_page' => $judul));
		$this->load->view('login', array('msg' => $pesan));
		$this->load->view('common/footer');
	}

	public function checkingLogin()
	{
		$this->load->model('Account');
		$judul = 'Register Page';
		$this->form_validation->set_rules(
			'username', //form field name
			'Username', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'sandi', //form field name
			'Kata Sandi', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			$this->load->view('common/header', array('judul_page' => $judul));
			// $this->load->view('common/topmenu');
			$this->load->view('login', array('msg' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$users = $this->Account->getIDUser();

		$judul = 'Login Page';
		#cek apakah return array ada isinya
		if (sizeof($users) <= 0) {
			$this->load->view('common/header', array('judul_page' => $judul));
			// $this->load->view('common/topmenu');
			$this->load->view('login', array('msg' => 'Incorrect Username or Password!'));
			$this->load->view('common/footer');
		} else {
			#jika ada maka bikin session array
			$id_current_grup = $this->Account->getIDOnGroup($users[0]['id_user'], $users[0]['id_grup']);

			$sess_array = array(
				'id_user' => $users[0]['id_user'],
				'nama' => $users[0]['nama'],
				'username' => $users[0]['username'],
				'id_grup' => $users[0]['id_grup'],
				'nama_grup' => $users[0]['nama_grup'],
				'current_grup' => $users[0]['id_user'],
				'id_on_grup' => $id_current_grup
			);

			#masukin array ke session
			$this->session->set_userdata('logged_in', $sess_array);
			
			switch ($users[0]['id_grup']) {
				case '1':
					redirect('editorCtl/index/' . $users[0]['id_user']);
					break;
				case '2':
					redirect('reviewerCtl/index/' . $users[0]['id_user']);
					break;
				case '3':
					redirect('makelaarCtl/index/' . $users[0]['id_user']);
					break;
			}
		}
	}

	public function redirecting()
	{
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

	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		// session_destroy();
		redirect('index.php');
	}

	public function createAccount($pesan = '')
	{
		//isi ini
		$judul = 'Register Page';
		$this->load->view('common/header', array('judul_page' => $judul));
		$this->load->view('signup', array('msg' => $pesan));
		$this->load->view('common/footer');
	}

	public function creatingAccount()
	{
		$judul = 'Register Page';
		$this->load->model('Account');

		$this->form_validation->set_rules(
			'sandi', //form field name
			'Kata Sandi', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'username', //form field name
			'Username', //display
			'required|is_unique[users.username]|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'nama', //form field name
			'Nama', //display
			'required|trim|min_length[2]|max_length[128]|xss_clean' //args
		);
		$this->form_validation->set_rules(
			'email', //form field name
			'Email', //display
			'required|valid_email|is_unique[users.email]|trim|min_length[2]|max_length[256]|xss_clean' //args
		);

		$res = $this->form_validation->run();
		if ($res == FALSE) {
			$msg = validation_errors();
			//key dalam array adalah nama variabel yang dipakai di view tujuan
			$this->load->view('common/header', array('judul_page' => $judul));
			$this->load->view('signup', array('msg' => $msg));
			$this->load->view('common/footer');
			return FALSE;
		}

		$this->session->set_flashdata('msgSuccess', '
		<div class="alert alert-success alert-dismissible fade show" role="alert">
		You have created your account, please login!
		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
		</div>
		');

		$users = $this->Account->insertNewUser();
		// redirect('accountctl/login/' . $id_user);
		redirect('accountctl/Login/');
	}



	public function profile()
	{
		if (!$this->session->userdata('logged_in')) {
			redirect('welcome/login');
		}
		$session_data = $this->session->userdata('logged_in');

		// $this->load->helper(array('form', 'url'));

		$this->load->model("Account");
		$user = $this->Account->getUser($session_data['id_user']);
		$roles = $this->Account->getRoles($session_data['id_user']);


		$this->load->view(
			'common/header_' . $session_data['nama_grup'],
			array("session_data" => $session_data)
		);
		$this->load->view('profile', array(
			"error" => "",
			"user" => $user[0],
			"roles" => $roles
		));
		$this->load->view('common/footer');
	}

	public function updateProfile()
	{
		$this->load->model('Account');
		$session_data = $this->session->userdata('logged_in');
		$user = $this->Account->getUser($session_data['id_user']);
		$roles = $this->Account->getRoles($session_data['id_user']);

		$config['upload_path']          = './photos/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 50;
		$config['max_width']            = 150;
		$config['max_height']           = 200;
		$config['overwrite'] = TRUE;

		$new_name = $session_data['username'] . '_profilepicture';
		$config['file_name'] = $new_name;

		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('photo')) {
			// gagal upload
			// if ($_FILES["photo"]['error'] != 4) {
			// } else {

			$error = $this->upload->display_errors();

			$this->load->view(
				'common/header_' . $session_data['nama_grup'],
				array("session_data" => $session_data)
			);
			$this->load->view('profile', array(
				"error" => $error,
				"user" => $user[0],
				"roles" => $roles
			));
			$this->load->view('common/footer');
			return;
			// }
		}

		$data = array('upload_data' => $this->upload->data());
		$users2 = $this->Account->setUser($session_data['id_user']);

		$users = $this->Account->getUser($session_data['id_user']);

		$sess_array = array(
			'id_user' => $users[0]['id_user'],
			'nama' => $users[0]['nama'],
			'username' => $users[0]['username'],
			'id_grup' => $users[0]['id_grup'],
			'nama_grup' => $users[0]['nama_grup'],
			'current_grup' => $users[0]['id_user'],
		);
		$this->session->set_userdata('logged_in', $sess_array);
		$session_data = $this->session->userdata('logged_in');
		redirect('accountctl/profile');
	}
}
