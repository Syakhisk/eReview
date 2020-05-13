<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Debug extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();


	}

	public function index()
	{
		$this->load->view('common/header');
		$this->load->view('debug');
		$this->load->view('common/footer');
	}

	public function test($param = ""){
		echo "hello";
		echo $param;
	}
}
