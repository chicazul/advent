<?php
class Products extends CI_Controller {
	public function __construct() 
	{
		parent::__construct();
	}

	// display all products
	public function index() 
	{
		$products = new Product();
		$products->get_products();
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
		$product->get_products($slug);

		if(empty($product->all)) 
		{
			show_404();
		}

		$data['title'] = $product->productname;
		$data['product'] = $product;

		$this->load->view('templates/header', $data);
		$this->load->view('products/view', $data);
		$this->load->view('templates/footer');
	}

	public function thankyou()
	{
		$data['title'] = 'Thank you!';
		
		$this->load->view('templates/header', $data);
		$this->load->view('products/thankyou', $data);
		$this->load->view('templates/footer');
	}

	// create a new product
	public function create() 
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		$this->load->library('login_manager');

		$product = new Product();
		$data['title'] = 'Create a product';
		$data['product'] = $product;

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