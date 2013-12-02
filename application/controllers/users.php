<?php
class Users extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		// require admin access
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

		$this->form_validation->set_rules('username', 'Username', 'required|min_length[5]|max_length[12]|is_unique[users.username]');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
		$data = array(
					'title' => 'Log In',
					'user' => $user
			);
		$this->load->view('templates/header', $data);
		$this->load->view('users/register', $data);
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
				$user->from_array($_POST, array('password', 'confirm_password'));
			}
			
			// Load and save the reset of the data at once
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