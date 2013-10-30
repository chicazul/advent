<?php

class Image extends DataMapper {
	public $has_many = array('product' => array('class' => 'product',
												'join_table' => 'products_images')
	);
}
?>