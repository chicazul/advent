<?php
class Posts extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		$this->load->model('post_model');
	}

	// display all posts
	public funtion index() 
	{
		$data['posts'] = $this->post_model->get_news();
		$data['title'] = 'History';

		$this->load->view('templates/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	// display a single post
	public function view($slug) 
	{
		$data['post_item'] = $this->post_model->get_post($slug);

		if(empty($data['post_item'])) 
		{
			show_404();
		}

		$data['title'] = $data['post_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}

	// create a new post
	public function create() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a post';

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');
		$this->form_validation->set_rules('blurb', 'blurb', 'required');

		if($this->form_validation->run() === FALSE) 
		{
			$this->load->view('templates/header', $data);
			$this->load->view('posts/create', $data);
			$this->load->view('templates/footer');
		} else 
		{
			$this->post_model->set_post();
			$this->load->view('posts/success');
		}
	}

}
?>