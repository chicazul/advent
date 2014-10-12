<?php
class Post extends DataMapper {
	public $has_one = array(
		'author' => array(
			'class' => 'user',
			'other_field' => 'created_post')
		);
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

	public function set_post($data, $new = FALSE) 
	{

		$this->from_array($data, array(
			'title',
			'slug',
			'blurb',
			'content'
		));
		if($new)
		{
			return $this->save();
		}
		return $this->save();
	}
}

?>