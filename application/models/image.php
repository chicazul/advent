<?php

class Image extends DataMapper {
	public $has_many = array('product' => array('class' => 'product',
												'join_table' => 'products_images')
	);

	public function get_images($id = -1)
	{
		if($id < 0)
		{
			$result = $this->get();
		}
		else
		{
			$result = $this->where('id', $id)->get();
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