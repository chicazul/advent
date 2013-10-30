<?php

class Product extends DataMapper {
	public $prefix = "";
	public $table = 'products';
	public $has_many = array('productattribute','image');

	function get_products($slug = FALSE)
	{
		if($slug == FALSE)
		{
			$result = $this->get();
			if(!empty($result->all))
			{
				foreach($result as $p)
				{
					$p->image->where('primaryimage', TRUE)->get();
				}
			}
		}
		else
		{
			$result = $this->where('slug', $slug)->get();

			if(!empty($result->all))
			{
				$this->image->get();
				$this->productattribute->get();
				foreach($this->productattribute as $a)
				{
					$a->attribute->get();
					$a->option->get();
				}
			}
		}

	}
}
class Attribute extends DataMapper {
	public $table = 'attributes';
	public $has_many = array('productattribute'
							);
}
class ProductAttribute extends DataMapper {
	public $table = 'productattributes';
	public $has_one =  array('product', 'attribute');
	public $has_many = array('option');
}
class Option extends DataMapper {
	public $table = 'options';
	public $has_many = array('productattribute');
}
?>