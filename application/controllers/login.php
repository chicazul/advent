<?php

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->library('login_manager', array('autologin' => FALSE));
	}

	function index()
	{
		$this->load->helper('form');
		$this->load->helper('array');
		$user = $this->login_manager->get_user();
		if($user !== FALSE)
		{
			// already logged in, redirect
		}

		$user = new User();
		if($this->input->post('username') !== FALSE)
		{
			// load data from attempted login
			$user->from_array($_POST, array('username','password'));
			// call validation of login request
			$login_redirect = $this->login_manager->process_login($user);
			echo $login_redirect;
			if($login_redirect)
			{
				if($login_redirect === TRUE)
				{
					// if no redirection page, redirect to welcome page
					redirect('welcome');
				}
				else
				{
					// otherwise, redirect to stored last-accessed page
					redirect($login_redirect);
				}
			}
		}

		$this->load->view('templates/header',array('title' => 'Log In'));
		$this->load->view('login',array('user' => $user));
		$this->load->view('templates/footer');
	}
}
?>