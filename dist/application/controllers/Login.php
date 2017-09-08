<?php
/**
 * CodeIgniter
 *
 * This controller contains the basic functions of the login system.
 *
 * All routes of the login system can be finded in 'config/routes.php' file.
 * You can change any route that you wish, in order to improve your App
 * experience. If you want make changes in that class, extends it in another
 * file.
 *
 * @since Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Login Controller
 *
 * @package CodeIgniter
 */
class Login extends CI_Controller {

	/**
	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();

		/* Models. */
		$this->load->model('Setup_Model');
		$this->load->model('Users_Model');

		/* Setup trigger. */
		$this->Setup_Model->setup_trigger();
	}

	/**
	 * Index
	 *
	 * The login page with the login form.
	 *
	 * @return void
	 */
	public function index()
	{
		$data = array();

		/* Login feedback. */
		$data['login_error'] = $this->input->get('login_error');

		/* View. */
		$this->load->view('app/login/login', $data);
	}

	/**
	 * Make Login
	 *
	 * The method of route to make login.
	 *
	 * @return void
	 */
	public function make_login()
	{
		$login_data = array(
			'user_login' => $this->input->post('login'),
			'user_pass' => md5($this->input->post('password'))
		);

		$user = $this->Users_Model->get_user_by('user_login', $login_data['user_login']);

		if($login_data['user_pass'] === $user->user_pass){
			$session_data = array(
				'user_login' => $user->user_login,
				'user_email' => $user->user_email
			);

			$this->Users_Model->create_session($session_data);

			/* Redirect to dashboard. */
			redirect('/dashboard');

			return false;
		}

		redirect('/login/?login_error=true');
	}

	/**
	 * Make Logout
	 *
	 * The method of route to make logout.
	 *
	 * @return void
	 */
	public function make_logout()
	{
		$this->Users_Model->logout();
	}

}
