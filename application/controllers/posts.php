<?php
class Posts extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
	}

	// display all posts
	public function index() 
	{
		$posts = new Post();
		$posts->get_posts();

		$data['posts'] = $posts;
		$data['title'] = 'History';

		$this->load->view('templates/header', $data);
		$this->load->view('posts/index', $data);
		$this->load->view('templates/footer');
	}

	// display a single post
	public function view($slug) 
	{
		$post = new Post();
		$post->get_posts($slug);

		if(empty($post->all))
		{
			show_404();
		}

		$data['title'] = $post->title;
		$data['post'] = $post;

		$this->load->view('templates/header', $data);
		$this->load->view('posts/view', $data);
		$this->load->view('templates/footer');
	}

	// create a new post
	public function create() 
	{	
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('login_manager');
		$post = new Post();

		$data['pagetitle'] = 'Create a post';
		$data['url'] = 'posts/create';
		$data['post'] = $post;

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');
		$this->form_validation->set_rules('blurb', 'blurb', 'required');

		if($this->form_validation->run() === FALSE) 
		{
			$this->load->view('templates/header', $data);
			$this->load->view('posts/edit', $data);
			$this->load->view('templates/footer');
		} else 
		{
			$post->set_post($_POST);

			$this->load->view('templates/header', $data);
			$this->load->view('posts/success', array('post' => $post));
			$this->load->view('templates/footer');
		}
	}

	public function save()
	{
		//echo 'saving!' . serialize($_POST);
		$this->edit('save');
	}

	public function edit($slug = '')
	{

		$this->load->helper('form');
		$this->load->library('login_manager');
		// Create Post Object
		$post = New Post();

		if($slug == 'save')
		{
			// Try to save the post
			$slug = $this->input->post('slug');
			$post->get_posts($slug);
			
			$post->trans_start();
			
			// Load and save the rest of the data at once
			$success = $post->from_array($_POST, array(
				'title',
				'blurb',
				'content'
			), TRUE); // TRUE means save immediately
			
			$post->trans_complete();
			// redirect on save
			if($success)
			{
				if($slug)
				{
					$this->session->set_flashdata('message', 'The post ' . $post->title . ' was successfully created.');
				}
				else
				{
					$this->session->set_flashdata('message', 'The post ' . $post->title . ' was successfully updated.');
				}
				redirect('posts');
			}
		}
		else
		{
			// load an existing post
			$post->get_posts($slug);
		}
		

		if($slug !== '')
		{
			$title = 'Edit Post';
			$url = 'posts/save';
		} else
		{
			$title = 'Create Post';
			$url = 'posts/create';
		}

		$data = array(
					'pagetitle' => $title,
					'url' => $url,
					'post' => $post
			);
		$this->load->view('templates/header', $data);
		$this->load->view('posts/edit', $data);
		$this->load->view('templates/footer');
	}

}
?>