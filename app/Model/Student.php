<?php
	class Student extends AppModel
	{
		public $hasOne = array('User');
		public $hasMany = array();
		public $belongsTo = array('Department');

		public $validate = array(
			'id_no' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Student ID No. is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 8, 15),
	                'message' => 'Between 8 to 15 characters'
	            ),
	            'unique' => array(
	            	'rule' => 'isUnique',
	            	'message' => 'Student ID No. already exist'
	            )
			),
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
			'department_id' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Department is required'
				)
			),
			'gender' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Gender is required'
				)
			),
			'date_of_birth' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Date of Birth is required'
				)/*,
				'date' => array(
		            'rule' => 'date',
		            'message' => 'Enter a valid date'
	            )*/
	        ),
	        'date_of_admission' => array(
	        	'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Date of Joining is required'
				)/*,
				'date' => array(
		            'rule' => 'date',
		            'message' => 'Enter a valid date'
	            )*/
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
			)
		);
	}