<?php
	class Department extends AppModel
	{
		public $hasMany = array('Employee', 'User', 'OfferCourse', 'Course');
		public $belongsTo = array();

		public $validate = array(
			'name' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Name is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 2, 140),
	                'message' => 'Between 2 to 140 characters'
	            )
			),
			'short_name' => array(
				'notBlank' => array(
					'rule' => 'notBlank',
					'message' => 'Short Name is required'
				),
				'between' => array(
	                'rule' => array('lengthBetween', 1, 25),
	                'message' => 'Between 1 to 25 characters'
	            )
			),
			'code' => array(				
				'between' => array(
	                'rule' => array('lengthBetween', 1, 25),
	                'message' => 'Between 1 to 25 characters',
	                'allowEmpty' => true
	            )
			),
			'description' => array(				
				'between' => array(
	                'rule' => array('lengthBetween', 2, 500),
	                'message' => 'Between 2 to 500 characters',
	                'allowEmpty' => true
	            )
			)
		);
	}