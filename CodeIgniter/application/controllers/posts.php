<?php
class Posts extends CI_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('post_model');
	}

	public funtion index() {
		$data['posts'] = $this->post_model->get_news();
		$data['title'] = 'History';

		$this->load->view('templates/header', $data);
		$this->load->view('news/index', $data);
		$this->load->view('templates/footer');
	}

	public function view($slug) {
		$data['posts'] = $this->post_model->get_news($slug);
	}

	public function view($slug) {
		$data['post_item'] = $this->post_model->get_post($slug);

		if(empty($data['post_item'])) {
			show_404();
		}

		$data['title'] = $data['post_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->view('templates/footer');
	}

}
?>