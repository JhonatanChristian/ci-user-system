<?php
/**
 * CodeIgniter
 *
 * This model contains the settings to install the system in the first time
 * that he opens.
 *
 * You can change the login and the password of the default user created by the
 * system. To make this, change the values of '$default_user' and
 * '$default_pass' to whatever you wish.
 *
 * @package CodeIgniter
 * @since Version 1.0.0
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Setup Model
 *
 * @package CodeIgniter
 */
class Setup_Model extends CI_Model {

	/**
	 * Default User
	 *
	 * @var string
	 */
	protected $default_user = 'Master';

	/**
	 * Default Pass
	 *
	 * @var string
	 */
	protected $default_pass = 'password';

	/**
	 * Class constructor
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->load->model('Users_Model');
	}

	/**
	 * Check Default Tables
	 *
	 * Verify if the default tables exists.
	 *
	 * @return bool
	 */
	public function check_default_tables()
	{
		$users_table_exists = $this->Users_Model->users_table_exists();
		$usermeta_table_exists = $this->Users_Model->usermeta_table_exists();

		if($users_table_exists === false || $usermeta_table_exists === false){
			return false;
		}

		return true;
	}

	/**
	 * Create Default Tables
	 *
	 * Creates the basic tables for the system operation.
	 *
	 * @return bool
	 */
	public function create_default_tables()
	{
		$this->Users_Model->create_users_table();
		$this->Users_Model->create_usermeta_table();

		return true;
	}

	/**
	 * Create Default User
	 *
	 * Creates a default user for the system.
	 *
	 * @return bool
	 */
	public function create_default_user()
	{
		$user_data = array(
			'ID'              => '',
			'user_login'      => $this->default_user,
			'user_pass'       => $this->default_pass,
			'user_email'      => '',
			'user_level'      => 5
		);

		$this->Users_Model->create_user($user_data, true);

		return true;
	}

	/**
	 * Setup Trigger
	 *
	 * Trigger to initiate the system installation.
	 *
	 * @return void
	 */
	public function setup_trigger()
	{
		if($this->check_default_tables() === false){
			$this->create_default_tables();
			$this->create_default_user();
		}

		return null;
	}

}
