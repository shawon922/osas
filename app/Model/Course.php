<?php
	class Course extends AppModel
	{
		public $hasMany = array();
		public $belongsTo = array();

		public $validate = array(
			
			'code' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Course Code is required'
				),				
				'between' => array(
	                'rule' => array('lengthBetween', 3, 15),
	                'message' => 'Between 3 to 15 characters'
	            ),
	            'unique' => array(
	            	'rule' => 'isUnique',
	            	'message' => 'Course Code already exist'
	            )
			),			
			'name' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Email is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 2, 90),
	                'message' => 'Between 2 to 90 characters'
	            )
			),
			'credit' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Course Credit is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 1, 4),
	                'message' => 'Between 1 to 4 digits'
	            )
			)
		);
	}