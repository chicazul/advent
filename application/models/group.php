<?php
class Group extends DataMapper {
	public $has_many = array('post','user');

	function get_groups($id = 0)
	{
		if($id === 0) 
		{
			$query = $this->get();
			return $query->all;
		}

		$query = $this->get_where(array('id' => $id));
		return $query->all;
	}

}
?>