<?php
class User extends DataMapper {
	public $has_many = array(
		'created_post' => array(
			'class' => 'post',
			'other_field' => 'author')
		);
	public $has_one = array('group');

	/**
	 * Login
	 *
	 * Authenticates a user for logging in.
	 *
	 * @access	public
	 * @return	bool
	 */
	function login()
	{
		// backup username for invalid logins
		$uname = $this->username;
		
		$u = new User();

		// Get user's stored record via their username
		$u->where('username', $uname)->get();

		if(validate_password($this->password, $u->password))
		{
			$this->get();
		}
		else
		{
			$this->clear();
		}
		
		// If there was no matching record, this user would be completely cleared so their id would be empty.
		if ($this->exists())
		{
			// Login succeeded
			$this->group->get();
			return TRUE;
		}
		else
		{
			// Login failed, so set a custom error message
			$this->error_message('login', $this->localize_label('error_login'));

			// restore username for login field
			$this->username = $uname;

			return FALSE;
		}
	}

	/**
	 * Encrypt (prep)
	 *
	 * Encrypts the supplied variable with a random salt using pbkdf2.
	 *
	 * @access	private
	 * @param	string
	 * @return	void
	 */
	function _encrypt($field)
	{
		if (!empty($this->{$field}))
		{
			$this->{$field} = create_hash($this->{$field});
		}
	}


}
?>