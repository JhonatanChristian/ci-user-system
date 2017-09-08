<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		/* Models. */
		$this->load->model('Users_Model');

		/* Ask Login. */
		$this->Users_Model->ask_login();
	}

	public function index()
	{
		$this->load->view('app/dashboard/home');
	}

}
