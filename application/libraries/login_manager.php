<?php

/**
 * Datamapper library
 * Simple utility class to handle logins.
 */
class Login_Manager {
	
	var $logged_in_user = NULL;
	
	function __construct($params = array())
	{
		$this->CI =& get_instance(); 
		$this->CI->load->library('session');
		$this->session =& $this->CI->session;
		
		if( ! isset($params['autologin']) || $params['autologin'] !== FALSE)
		{
			$required_group = -1;
			if(isset($params['required_group']))
			{
				$required_group = $params['required_group'];
			}
			$this->check_login($required_group);
		}
	}
	
	/**
	* check_login
	* Validates that user is logged in and has permission to access this page.
	* If not, redirects to login page or error message.
	* 
	* @param integer $required_group Group id required to access this page
	* @return none
	*/
	function check_login($required_group = -1)
	{
		// Special auto-setup routine
		if( ! $this->CI->db->table_exists('users'))
		{
			redirect('admin/reset_warning');
		}
		else
		{
			// see if there are any users in the system
			$u = new User();
			if($u->count() == 0)
			{
				redirect('admin/init');
			}
		}
		// if not logged in, automatically redirect
		$u = $this->get_user();
		if($u === FALSE)
		{
			$this->session->set_userdata('login_redirect', $this->CI->uri->uri_string());
			redirect('login');
		}
		if($required_group > 0)
		{
			if($u->group->id > $required_group)
			{
				show_error('You do not have access to this section.');
			}
		}
	}
	
	/**
	 * process_login
	 * Validates that a username and password are correct.
	 * 
	 * @param object $user The user containing the login information.
	 * @return FALSE if invalid, TRUE or a redirect string if valid. 
	 */
	function process_login($user)
	{
		// attempt the login
		$success = $user->login();
		if($success)
		{
			// store the userid if the login was successful
			$this->session->set_userdata('logged_in_id', $user->id);
			// store the user for this request
			$this->logged_in_user = $user;
			// if a redirect is necessary, return it.
			$redirect = $this->session->userdata('login_redirect');
			if( ! empty($redirect))
			{
				$success = $redirect;
			}
		}
		// return TRUE or FALSE, or URI to redirect to after success
		return $success;
	}
	
	function logout()
	{
		$redirect = $this->session->userdata('login_redirect');
		$this->session->sess_destroy();
		$this->logged_in_user = NULL;
		if(empty($redirect))
		{
			$redirect = 'posts';
		}
		redirect($redirect);
	}
	
	function get_user()
	{
		if(is_null($this->logged_in_user))
		{
			if( ! $this->CI->db->table_exists('users'))
			{
				return FALSE;
			}
			$id = $this->session->userdata('logged_in_id');
			if(is_numeric($id))
			{
				$u = new User();
				$u->get_by_id($id);
				if($u->exists()) {
					$u->group->get();
					$this->logged_in_user = $u;
					return $this->logged_in_user;
				}
			}
			return FALSE;
		}
		else
		{
			echo $this->logged_in_user->group_id;
			return $this->logged_in_user;
		}
	}
	
}
