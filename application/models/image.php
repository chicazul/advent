<?php

class Image extends CI_Model {
	public $artist;
	public $source;
	public $description;
	public $image;

	public function get_images($id = -1)
	{
		if($id < 0)
		{
			$result = $this->db->get('images');
		}
		else
		{
			$result = $this->db->get_where('images', 'id', $id)->get();
		}
		return $result->all;
	}

	public function set_image($data)
	{
		$this->from_array($data, array(
			'artist',
			'source',
			'description',
			'image'
			));
		return $this->save();
	}
}
?>