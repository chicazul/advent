$config = array(
				'login' => array(
								array(
									'field' => 'username',
									'label' => 'Username',
									'rules' => 'required'
									),
								array(
									'field' => 'password',
									'label' => 'Password',
									'rules' => 'required'
									)
								),
				'user/register' => array(
								array(
									'field' => 'username',
									'label' => 'Username',
									'rules' => 'required|is_unique|min_length[3]'
									),
								array(
									'field' => 'displayname',
									'label' => 'Display Name',
									'rules' => 'required|valid_email'
									),
								array(
									'field' => 'email',
									'label' => 'Email',
									'rules' => 'required'
									),
								array(
									'field' => 'password',
									'label' => 'Password',
									'rules' => 'required|min_length[8]'
									)
								),
			);