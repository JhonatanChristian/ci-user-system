<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Users Model
 *
 * @since Version 1.0.0
 */
class Users_Model extends CI_Model {

	/**
	 * The user table.
	 *
	 * @var string
	 */
	protected $users_table = 'users';

	/**
	 * The user meta table.
	 *
	 * @var string
	 */
	protected $usermeta_table = 'usermeta';

	/**
	 * Construct
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Create Users Table
	 *
	 * Creates the users table.
	 *
	 * @return void
	 */
	public function create_users_table()
	{
		$query = "
			CREATE TABLE IF NOT EXISTS {$this->users_table} (
				ID BIGINT(20) NOT NULL AUTO_INCREMENT,
				user_registered DATETIME,
				user_login VARCHAR(60),
				user_pass VARCHAR(255),
				user_email VARCHAR(100),
				user_level INT(1),
				PRIMARY KEY (ID)
			);
		";

		$this->db->query($query);
	}

	/**
	 * Create Usermeta Table
	 *
	 * Creates the usermeta table.
	 *
	 * @return void
	 */
	public function create_usermeta_table()
	{
		$query = "
			CREATE TABLE IF NOT EXISTS {$this->usermeta_table} (
				meta_id BIGINT(20) NOT NULL AUTO_INCREMENT,
				user_id BIGINT(20),
				meta_key VARCHAR(255),
				meta_value LONGTEXT,
				PRIMARY KEY (meta_id)
			);
		";

		$this->db->query($query);
	}

	/**
	 * Users Table Exists
	 *
	 * Verify if the users table exists.
	 *
	 * @return bool
	 */
	public function users_table_exists()
	{
		$query = "SHOW TABLES LIKE '{$this->users_table}'";

		$return = $this->db->query($query);

		if($return->result_id->num_rows > 0){
			return true;
		}

		return false;
	}

	/**
	 * Usermeta Table Exists
	 *
	 * Verify if the usermeta table exists.
	 *
	 * @return bool
	 */
	public function usermeta_table_exists()
	{
		$query = "SHOW TABLES LIKE '{$this->usermeta_table}'";

		$return = $this->db->query($query);

		if($return->result_id->num_rows > 0){
			return true;
		}

		return false;
	}

	/**
	 * Create User
	 *
	 * Insert the user data on users table.
	 * If the param 'replace' is true, then user data will be update, case the
	 * value 'user_login' already exists.
	 *
	 * @param user_data => The user data (array)
	 * @param replace   => Replace the data or return error (bool)
	 *
	 * @return last insert ID (int)
	 */
	public function create_user( $user_data, $replace = false )
	{
		$data = array(
			'ID'              => '',
			'user_registered' => date('Y-m-d H:i:s'),
			'user_login'      => $user_data['user_login'],
			'user_pass'       => md5($user_data['user_pass']),
			'user_email'      => $user_data['user_email'],
			'user_level'      => $user_data['user_level']
		);

		/* Checks the existence of the user. */
		$user_exists = $this->get_user_by('user_login', $user_data['user_login']);

		if(!empty($user_exists) && $replace === false){
			return false;
		}

		if(!empty($user_exists) && $replace === true){
			$this->update_user($user_exists->ID, $user_data);

			return $user_exists->ID;
		}

		/* Create user. */
		$this->db->insert($this->users_table, $data);

		return $this->db->insert_id();
	}

	/**
	 * Get User By
	 *
	 * Get the user data by 'ID' or 'login'.
	 *
	 * @param field => 'ID' or 'user_login' (string)
	 * @param value => The value ofthe field (string | int)
	 *
	 * @return user data (object)
	 */
	 public function get_user_by( $field, $value )
	 {
		 $where = array();

		 if($field === 'ID' || $field === 'user_login'){
			 $where = array($field => $value);
		 } else {
			 return false;
		 }

		 $return = $this->db->get_where($this->users_table, $where);

		 if($return->result_id->num_rows > 0){
			 $return = $return->result();

			 return $return[0];
		 }

		 return false;
	 }

	/**
	 * Update User
	 *
	 * Updates the user data.
	 *
	 * @param user_id   => The user ID (int)
	 * @param user_data => The user data (array)
	 *
	 * @return bool
	 */
	public function update_user( $user_id, $user_data )
	{
		$data = array(
			'user_pass'  => md5($user_data['user_pass']),
			'user_email' => $user_data['user_email'],
			'user_level' => $user_data['user_level']
		);

		$this->db->update($this->users_table, $data, array('ID' => $user_id));

		return true;
	}

	/**
	 * Get Users
	 *
	 * Get the users.
	 *
	 * @param array $args {
	 *   'id_in'     => array(1, 2, 3, ...)
	 *   'id_not_in' => array(1, 2, 3, ...)
	 *   's'         => 'search string'
	 *   'order_by'  => 'ID' (or any column of the table)
	 *   'order'     => 'ASC' or 'DESC'
	 *   'offset'    => 0
	 *   'limit'     => 10
   * }
	 *
	 * @return array
	 */
	public function get_users( $args = array() )
	{
		/* ID IN. */
		$id_in = '';
		if(array_key_exists('id_in', $args)){
			foreach($args['id_in'] as $keys => $value){
				$id_in .= $value . ', ';
			}
			$id_in = substr($id_in, 0, -2);
			$id_in = "AND {$this->users_table}.ID IN (" . $id_in . ")";
		}

		/* ID NOT IN. */
		$id_not_in = '';
		if(array_key_exists('id_not_in', $args)){
			foreach($args['id_not_in'] as $keys => $value){
				$id_not_in .= $value . ', ';
			}
			$id_not_in = substr($id_not_in, 0, -2);
			$id_not_in = "AND {$this->users_table}.ID NOT IN (" . $id_not_in . ")";
		}

		/* Search. */
		$search = '';
		if(array_key_exists('s', $args)){
			$search = $args['s'];

			$search = "AND (({$this->users_table}.user_login LIKE '%{$search}%') OR ({$this->users_table}.user_email LIKE '%{$search}%') OR ({$this->usermeta_table}.meta_key LIKE '%{$search}%') OR ({$this->usermeta_table}.meta_value LIKE '%{$search}%'))";
		}

		/* Order by. */
		$order_by = "ORDER BY ID";
		if(array_key_exists('order_by', $args)){
			if(!empty($args['order_by'])){
				$order_by = $args['order_by'];
				$order_by = "ORDER BY {$order_by}";
			}
		}

		/* Order. */
		$order = "ASC";
		if(array_key_exists('order', $args)){
			if(!empty($args['order'])){
				$order = $args['order'];
				$order = "{$order}";
			}
		}

		/* OFFSET & LIMIT */
		$offset = 0;
		if(array_key_exists('offset', $args)){
			$offset = $args['offset'];
		}

		$limit = 10;
		if(array_key_exists('limit', $args)){
			if(!empty($args['limit'])){
				$limit = $args['limit'];
			}
		}

		$limit_data = "LIMIT {$offset}, {$limit}";

		/* Query. */
		$query = "SELECT DISTINCT {$this->users_table}.ID FROM {$this->users_table} LEFT JOIN {$this->usermeta_table} ON {$this->users_table}.ID = {$this->usermeta_table}.user_id WHERE 1 {$search} {$id_in} {$id_not_in} {$order_by} {$order} {$limit_data}";

		$return = $this->db->query($query)->result();

		return $return;
	}

	/**
	 * Delete User
	 *
	 * Delete the user.
	 *
	 * @param user_id => The user ID (int)
	 *
	 * @return bool
	 */
	public function delete_user( $user_id )
	{
		$this->db->delete($this->users_table, array('ID' => $user_id));
		$this->delete_user_meta($user_id);

		return true;
	}

	/**
	 * --------------------------------------------------------------------------
	 * Login Methods
	 * --------------------------------------------------------------------------
	 *
	 * Create Session
	 *
	 * Creates the login cookie for the user session.
	 *
	 * @return void
	 */
	public function create_session( $session_data )
	{
		$data = array(
			'login'     => $session_data['user_login'],
			'email'     => $session_data['user_email'],
			'logged_in' => true
		);

		$this->session->set_userdata($data);
	}

	/**
	 * Login Check
	 *
	 * Checks if the user is logged in.
	 *
	 * @return bool
	 */
	public function login_check()
	{
		$userdata = $this->session->userdata();

		if(!array_key_exists('logged_in', $userdata)){
			$userdata['logged_in'] = false;
		}

		if($userdata['logged_in'] === true){
			return true;
		}

		return false;
	}

	/**
	 * Ask Login
	 *
	 * Restricts the access only for logged users.
	 *
	 * @return void
	 */
	public function ask_login()
	{
		if($this->login_check() === false){
			redirect('/login');
		}

		return null;
	}

	/**
	 * Logout
	 *
	 * Execute logout.
	 *
	 * @return void
	 */
	public function logout()
	{
		$this->session->sess_destroy();

		redirect('/login');

		return null;
	}

	/**
	 * --------------------------------------------------------------------------
	 * Usermeta
	 * --------------------------------------------------------------------------
	 *
	 * Insert User Meta
	 *
	 * Inserts the user meta data on the table.
	 *
	 * @param int $user_id       => User ID,
	 * @param string $meta_key   => The meta key,
	 * @param string $meta_value => The meta value
	 *
	 * @return Last insert ID
	 */
	public function insert_user_meta( $user_id, $meta_key, $meta_value )
	{
		$data = array(
			'meta_id'    => '',
			'user_id'    => $user_id,
			'meta_key'   => $meta_key,
			'meta_value' => $meta_value
		);

		$user_meta_exists = $this->get_user_meta($user_id, $meta_key);

		if(!empty($user_meta_exists)){
			$this->update_user_meta($user_id, $meta_key, $meta_value);
			return (int) $user_meta_exists->meta_id;
		}

		$this->db->insert($this->usermeta_table, $data);

		return $this->db->insert_id();
	}

	/**
	 * Update User Meta
	 *
	 * Updates a user meta.
	 *
	 * @param int $user_id       => User ID
	 * @param string $meta_key   => The meta key
	 * @param string $meta_value => The meta value
	 *
	 * @return bool
	 */
	public function update_user_meta( $user_id, $meta_key, $meta_value )
	{
		$data = array(
			'meta_value' => $meta_value
		);

		$this->db->update($this->usermeta_table, $data, array('user_id' => $user_id, 'meta_key' => $meta_key));

		return true;
	}

	/**
	 * Get User Meta
	 *
	 * Get a user meta.
	 *
	 * @param int $user_id          => User ID
	 * @param int $meta_key         => The meta key
	 * @param bool $only_meta_value => Return all data or only the meta value
	 *
	 * @return array or void
	 */
	public function get_user_meta( $user_id, $meta_key, $only_meta_value = false )
	{
		$query = "SELECT DISTINCT $this->usermeta_table.* FROM $this->usermeta_table WHERE user_id = {$user_id} AND meta_key = '{$meta_key}'";

		$return = $this->db->query($query);

		if($return->result_id->num_rows === 0){
			return null;
		}

		$return = $return->result();
		$return = $return[0];

		if($only_meta_value === true){
			$return = $return->meta_value;
		}

		return $return;
	}

	/**
	 * Delete User Meta
	 *
	 * Delte a single or all user meta data.
	 *
	 * @param int $user_id     => User ID
	 * @param string $meta_key => The meta key
	 *
	 * @return bool
	 */
	public function delete_user_meta( $user_id, $meta_key = '' )
	{
		$where = array(
			'user_id' => $user_id
		);

		if(!empty($meta_key)){
			$where['meta_key'] = $meta_key;
		}

		$this->db->delete($this->usermeta_table, $where);

		return true;
	}

}
