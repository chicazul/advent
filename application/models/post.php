<?php
class Post extends DataMapper {
    var $created_field = 'created';
    var $updated_field = 'updated';
	
	function get_posts($slug = FALSE)
	{
		if($slug === FALSE) 
		{
			$query = $this->get();
			return $query->all;
		}

		$query = $this->get_where(array('slug' => $slug));
		return $query->all;
	}

	public function set_post($data) 
	{
		$this->load->helper('url');

		$slug = url_title($data['title'], 'dash', TRUE);

		$this->title = $data['title'];
		//$this->author = // current user somehow but not sure how
		$this->slug = $slug;
		$this->blurb = $data['blurb'];
		$this->content = $data['content'];

		return $this->save();
	}
}

?>