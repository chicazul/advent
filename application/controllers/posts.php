<?php
class Posts extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
	}

	// display all posts
	public function index($style = 'index') 
	{
		if($style == 'list')
		{
			$this->load->library('login_manager');
		}

		$posts = new Post();
		$posts->get_posts();

		$data['posts'] = $posts;
		$data['title'] = 'History';


		$this->load->view('templates/header', $data);
		$this->load->view('posts/' . $style, $data);
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
		$this->edit();
	}

	public function save($new = FALSE)
	{
		$this->load->library('login_manager');
		$this->load->helper('url');
		// Create Post Object
		$post = New Post();

		$slug = url_title($this->input->post('title'), 'dash', TRUE);
		// See if post already exists
		if($new === FALSE)
		{
			$post->get_posts($slug);	
		}

		$_POST['slug'] = $slug;
		$_POST['author'] = $this->login_manager->get_user();

		$success = $post->set_post($_POST, $new);
		
		// redirect on save
		if($success)
		{
			$verb = $new ? 'created' : 'updated';
			$this->session->set_flashdata('message', 'The post <em>' . $post->title . '</em> was successfully ' . $verb);
			redirect('posts/list');
		}
		else
		{
			// could not save, find a way to show error
		}
	}

	public function edit($slug = '')
	{

		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('login_manager');
		// Create Post Object
		$post = New Post();

		$post->get_posts($slug);
		

		if($slug !== '')
		{
			$title = 'Edit Post';
			$url = 'posts/save';
		} else
		{
			$title = 'Create Post';
			$url = 'posts/save/new';
		}

		$data = array(
					'title' => $title,
					'url' => $url,
					'post' => $post
			);

		$this->form_validation->set_rules('title', 'title', 'required');
		$this->form_validation->set_rules('content', 'content', 'required');
		$this->form_validation->set_rules('blurb', 'blurb', 'required');

		$this->load->view('templates/header', $data);
		$this->load->view('posts/edit', $data);
		$this->load->view('templates/footer');
	}

	public function delete($slug)
	{
		$this->load->library('login_manager');

		$post = new Post();
		$post->get_posts($slug);

		if(empty($post->all))
		{
			show_404();
		}
		$title = $post->title;

		$post->trans_start();
		
		// Attempt delete
		$success = $post->delete();
		
		$post->trans_complete();

		// redirect when delete completed
		if($success)
		{
			$this->session->set_flashdata('message', 'The post <em>' . $title . '</em> was successfully deleted.');
			redirect('posts/list');
		}
	}
}
?>