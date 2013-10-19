<?php
class Post_model extends CI_Model {
	
	public function __construct() {
		$this->load->database();
	}

	// load all posts from db
	public function get_posts($slug = FALSE) {
		if($slug === FALSE) {
			$query = $this->db->get('posts');
			return $query->result_array();
		}

		$query = $this->db->get_where('posts', array('slug' => $slug));
		return $query->row_array();
	}

	// save a single post to database
	public function set_post() {
		$this->load->helper('url');

		$slug = url_title($this->input->post('title'), 'dash', TRUE);

		$data = array(
			'title' => $this->input->post('title'),
			'slug' => $slug,
			'blurb' => $this->input->post('blurb'),
			'content' => $this->input->post('text')
		);

		return $this->db->insert('posts', $data)
	}
}
?>