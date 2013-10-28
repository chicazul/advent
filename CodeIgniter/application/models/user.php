<?php
class User extends DataMapper {

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
		
		// Create a temporary user object
		$u = new User();

		// Get this users stored record via their username
		$u->where('username', $uname)->get();

		if(validate_password($this->password, $u->password))
		{
			echo "password valid";
			$this->get();
		}
		else
		{
			$this->clear();
		}
		
		echo $this->password;
		// If there was no matching record, this user would be completely cleared so their id would be empty.
		if ($this->exists())
		{
			// Login succeeded
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