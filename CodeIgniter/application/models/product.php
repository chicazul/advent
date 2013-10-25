<?php

class Product extends DataMapper {
	public $table = 'products';
	public $has_many = array('producttype', 'producttag');
}
/*
class Product_model extends CI_Model {
	
	public function __construct() 
	{
		$this->load->database();
	}

	// load all products from db
	public function get_products($slug = FALSE) 
	{
		$p = new Product();
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
			'description' => $this->input->product('description'),
			'thumbsrc' => $this->input->product('thumbsrc')
		);

		return $this->db->insert('products', $data);
	}
}*/

?>