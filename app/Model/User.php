<?php
	class User extends AppModel
	{
		public $hasMany = array();
		public $belongsTo = array('Employee', 'Designation');

		public $validate = array(
			'first_name' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'First Name is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 1, 40),
	                'message' => 'Between 1 to 40 characters'
	            )
			),
			'last_name' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Last Name is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 1, 40),
	                'message' => 'Between 1 to 40 characters'
	            )
			),
			'username' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Username is required'
				),
				'alphaNumeric' => array(
	                'rule' => 'alphaNumeric',
	                'required' => true,
	                'message' => 'Letters and numbers only'
	            ),
				'between' => array(
	                'rule' => array('lengthBetween', 4, 35),
	                'message' => 'Between 4 to 35 characters'
	            ),
	            'unique' => array(
	            	'rule' => 'isUnique',
	            	'message' => 'Username already exist'
	            )
			),
			'password' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Password is required',
					'on' => 'create'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 6, 55),
	                'message' => 'Between 6 to 55 characters',
					'on' => 'create'
	            )
			),
			'confirm_password' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Confirm Password is required',
					'on' => 'create'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 6, 55),
	                'message' => 'Between 6 to 55 characters',
					'on' => 'create'
	            )
			),
			'email' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Email is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 1, 45),
	                'message' => 'Between 1 to 45 characters'
	            ),
	            'unique' => array(
	            	'rule' => 'isUnique',
	            	'message' => 'Email already exist'
	            )
			),
			'contact_no' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Contact No. is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 11, 15),
	                'message' => 'Between 11 to 15 characters'
	            )
			),
			'address' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Address is required'
				),
				'between' => array(
	                'rule' => array('maxLength', 500),
	                'message' => 'Maximum 500 characters allowed'
	            )
			),
			'role_id' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Role is required'
				)
			)
		);
	}