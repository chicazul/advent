<?php

class Pages extends CI_Controller {

	public function view($page = 'index') 
	{
		if(!file_exists('application/views/pages/' . $page . '.php')) 
		{
			echo $page;
			show_404();
		}

		$data['title'] = ucfirst($page); // Capitalise first letter of page name

		$this->load->view('templates/header', $data);
		$this->load->view('pages/' .$page, $data);
		$this->load->view('templates/footer', $data);
	}
}

?>