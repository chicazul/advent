<?php
class Post extends CI_Model  {
	public $title;
    public $content;
    var $group;
	
	function get_posts($slug = FALSE, $group = 1)
	{
		if($slug === FALSE) 
		{
			// select only posts with a privacy less than or equal to supplied group
			//$result = $this->where_between_related_group('id',0, $group)->get();
			$result = $this->db->get('posts');

			/*if(!empty($result->all))
			{
				foreach($result as $p)
				{
					$p->group->get();
				}
			}*/
		} else
		{
			$result = $this->db->get_where('posts', array('slug' => $slug));

			if(!empty($result->all))
			{
				$this->group->get();
			}
		}

		return $result->all;
	}

	public function set_post($data) 
	{

		$this->from_array($data, array(
			'title',
			'slug',
			'blurb',
			'content'
		));
		$a = New User();
		$a = $data['author'];
		$g = New Group();
		$g->where('id',$data['group'])->get();
		return $this->save(array('author' => $a,'group' => $g));
	}
}

?>