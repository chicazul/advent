<?php
class Images extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		// require admin access
	}
	public function create()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$loginparam = array('required_group' => 2);
		$this->load->library('login_manager',$loginparam);

		$image = New Image();

		$data = array(
					'title' => 'Upload an Image',
					'image' => $image,
					'error' => ''
			);

		$this->load->view('templates/header', $data);
		$this->load->view('images/create', $data);
		$this->load->view('templates/footer');
	}

	public function edit($id = -1)
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$loginparam = array('required_group' => 2);
		$this->load->library('login_manager',$loginparam);

		$image = New Image();

		$image->get_images($id);

		if($id > 0)
		{
			$title = 'Edit Image';
			$url = 'images/save';
		} else
		{
			$title = 'Upload Image';
			$url = 'images/save/new';
		}

		$data = array(
					'title' => $title,
					'url' => $url,
					'image' => $image
			);

		$this->load->view('templates/header', $data);
		$this->load->view('images/edit', $data);
		$this->load->view('templates/footer');
	}

	public function save($new = FALSE)
	{

		$loginparam = array('required_group' => 2);
		$this->load->library('login_manager',$loginparam);

		// Create Image Object
		$image = New Image();

		// See if image already exists
		if($new === FALSE)
		{
			$id = $this->input->post('id');
			$image->get_images($id);	
		}

		$success = $image->set_image($this->input->post());
		
		// redirect on save
		if($success)
		{
			$verb = $new ? 'created' : 'updated';
			$this->session->set_flashdata('message', 'The image was successfully ' . $verb);
			redirect('images');
		}
		else
		{
			// could not save, find a way to show error
		}
	}

	/* Process uploaded images and automatically create resized version
	*/
	public function upload()
	{
		$this->load->helper('form');
		// Require login
		$loginconfig = array('required_group' => 2);
		$this->load->library('login_manager',$loginconfig);
		// Process file upload
		$uploadconfig = array(
			'upload_path' => './img/',
			'allowed_types' => 'gif|jpg|png',
			'max_size'	=> '500',
			'max_width'  => '1024',
			'max_height'  => '768'
		);
		$this->load->library('upload', $uploadconfig);

		// Upon error, reload file upload form
		if ( ! $this->upload->do_upload())
		{
			$data = array('error' => $this->upload->display_errors());

			$this->load->view('templates/header', $data);
			$this->load->view('images/create', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			// Dump file data into a variable for ease of access
			$upload = $this->upload->data();

			// Create a blank image object to pass
			$image = New Image();
			$image->get(0);
			
			$image->image = '/advent/img/' . $upload['file_name'];

			// create a 300px width version of the file
			$imageconfig = array(
					'source_image' => $upload['full_path'],
					'new_image' => '/img/300/' . $upload['file_name'],
					'width' => 300
				);
			$this->load->library('image_lib', $imageconfig);
			$this->image_lib->resize();

			$data = array(
				'image' => $image,
				'title' => 'Upload image',
				'url' => 'images/save/new'
				);

		$this->load->view('templates/header', $data);
		$this->load->view('images/edit', $data);
		$this->load->view('templates/footer');
		}
	}

	public function index()
	{
		$images = new Image();
		$images->get_images();
		$data = array(
					'title' => 'Gallery',
					'images' => $images
			);
		$this->load->view('templates/header', $data);
		$this->load->view('images/index', $data);
		$this->load->view('templates/footer');

	}
}
?>