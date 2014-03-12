<?php
class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		// require admin access
	}

	public function logout()
	{
		$this->load->library('login_manager');
		if($this->login_manager->get_user())
		{
			$this->login_manager->logout();
		}
	}

	public function login()
	{
		$this->load->library('login_manager', array('autologin' => FALSE));
		$this->load->helper('form');
		$this->load->helper('array');
		$user = $this->login_manager->get_user();
		if($user !== FALSE)
		{
			// already logged in, redirect <-- wait what does this mean there is no redirect here?
		}

		$user = new User();
		if($this->input->post('username') !== FALSE)
		{
			// load data from attempted login
			$user->from_array($_POST, array('username','password'));
			// call validation of login request
			$login_redirect = $this->login_manager->process_login($user);
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
		$this->load->view('users/login',array('user' => $user));
		$this->load->view('templates/footer');
	}
	public function index()
	{
		$this->load->library('form_validation');
		$this->load->library('login_manager');
		$users = new User();
		$users->get();
		$data = array(
					'title' => 'Users',
					'users' => $users
			);
		$this->load->view('templates/header', $data);
		$this->load->view('users/index', $data);
		$this->load->view('templates/footer');
	}

	public function create()
	{

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('login_manager');
		$user = new User();

		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[25]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$data = array(
					'title' => 'Log In',
					'user' => $user
			);
		$this->load->view('templates/header', $data);
		$this->load->view('users/edit', $data);
		$this->load->view('templates/footer');

	}

	public function save()
	{
		echo 'saving!' . serialize($_POST);
		$this->edit('save');
	}
	public function edit($id = -1)
	{

		$this->load->helper('form');
		$this->load->library('login_manager');
		// Create User Object
		$user = new User();
		echo empty($_POST);
		if($id == 'save')
		{
			// Try to save the user
			$id = $this->input->post('id');
			$this->_get_user($user, $id);
			
			$user->trans_start();
			
			// Only add the passwords in if they aren't empty
			// New users start with blank passwords, so they will get an error automatically.
			if( ! empty($_POST['password']))
			{
				// TOFIX: This uses DataMapper to write directly to DB without hashing password. How to do?
				$user->from_array(array('password'=>create_hash($_POST['password'])), array('password'));
			}
			
			// Load and save the rest of the data at once
			// The passwords saved above are already stored.
			$success = $user->from_array($_POST, array(
				'displayname',
				'email',
				'username'
			), TRUE); // TRUE means save immediately
			
			// redirect on save
			if($success)
			{
				$user->trans_complete();
				if($id < 1)
				{
					$this->session->set_flashdata('message', 'The user ' . $user->name . ' was successfully created.');
				}
				else
				{
					$this->session->set_flashdata('message', 'The user ' . $user->name . ' was successfully updated.');
				}
				redirect('users');
			}
		}
		else
		{
			// load an existing user
			$this->_get_user($user, $id);
		}
		

		if($id > 0)
		{
			$title = 'Edit User';
			$url = 'users/save';
		} else
		{
			$title = 'Add User';
			$url = 'users/add';
		}

		$data = array(
					'title' => $title,
					'url' => $url,
					'user' => $user
			);
		$this->load->view('templates/header', $data);
		$this->load->view('users/edit', $data);
		$this->load->view('templates/footer');
	}

	function _get_user($user, $id)
	{
		if( ! empty($id))
		{
			$user->get_by_id($id);
			if( ! $user->exists())
			{
				show_error('Invalid User ID');
			}
		}
	}
}
?>