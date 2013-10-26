<?php

class Product extends DataMapper {
	public $prefix = "";
	public $table = 'products';
	public $has_many = array(
							'attribute' => array('class' => 'ProductAttribute') , 
							'producttag'
							);
}
class ProductAttribute extends DataMapper {
	public $table = 'productattributes';
	public $has_many = array(
							'product' => array('join_table' => 'products_productattributes'),
							'option' => array('class' => 'AttributeOption',
											'other_field' => 'attribute',
											'join_self_as' => 'product_productattribute',
											'join_other_as' => 'attributeoption',
											'join_table' => 'productattributes_attributeoptions')
							);
}
class AttributeOption extends DataMapper {
	public $table = 'attributeoptions';
	public $has_many = array(
							'attribute' => array('class' => 'ProductAttribute',
												'other_field' => 'option',
												'join_self_as' => 'attributeoption',
												'join_other_as' => 'product_productattribute',
												'join_table' => 'productattributes_attributeoptions')
							);
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