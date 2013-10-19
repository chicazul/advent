<?php
class Product_model extends CI_Model {
	
	public function __construct() 
	{
		$this->load->database();
	}

	// load all products from db
	public function get_products($slug = FALSE) 
	{
		if($slug === FALSE) 
		{
			$query = $this->db->get('products');
			return $query->result_array();
		}

		$query = $this->db->get_where('products', array('slug' => $slug));
		return $query->row_array();
	}

	// save a single product to database
	public function set_product() 
	{
		$this->load->helper('url');

		$slug = url_title($this->input->product('productname'), 'dash', TRUE);

		$data = array(
			'productname' => $this->input->product('productname'),
			'slug' => $slug,
			'price' => $this->input->product('price'),
			'description' => $this->input->product('description')
		);

		return $this->db->insert('products', $data);
	}
}
?>