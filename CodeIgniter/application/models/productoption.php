<?php

class ProductOption extends DataMapper {
	public $table = 'productoptions';
	public $has_one = array('product');
}
?>