<?php
class Products extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
		//$this->load->model('product_model');
	}

	// display all products
	public function index() 
	{
		$products = new Product();
		$products->get();
		$data = array(
					'title' => 'Store',
					'products' => $products
			);
		$this->load->view('templates/header', $data);
		$this->load->view('products/index', $data);
		$this->load->view('templates/footer');
	}

	// display a single product
	public function view($slug) 
	{
		$product = new Product();
		$product->where('slug', $slug);

		if(empty($product)) 
		{
			show_404();
		}

		$data['title'] = $product->productname;
		$data['product'] = $product;

		$this->load->view('templates/header', $data);
		$this->load->view('products/view', $data);
		$this->load->view('templates/footer');
	}

	// create a new product
	public function create() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');

		$data['title'] = 'Create a product';

		$this->form_validation->set_rules('productname', 'productname', 'required');
		$this->form_validation->set_rules('description', 'description', 'required');
		$this->form_validation->set_rules('price', 'price', 'required');

		if($this->form_validation->run() === FALSE) 
		{
			$this->load->view('templates/header', $data);
			$this->load->view('products/create', $data);
			$this->load->view('templates/footer');
		} else 
		{
			$this->product_model->set_product();
			$this->load->view('products/success');
		}
	}

}
?>