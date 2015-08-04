<?php
class Group  {

	function get_groups($id = 0)
	{
		if($id === 0) 
		{
			$result = $this->get('groups');
			return $result->all;
		}

		$result = $this->get_where('groups', array('level' => $id));
		return $result->all;
	}

}
?>