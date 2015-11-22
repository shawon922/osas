<?php
	class Designation extends AppModel
	{
		public $hasMany = array('Employee');
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
			'description' => array(				
				'between' => array(
	                'rule' => array('lengthBetween', 2, 500),
	                'message' => 'Between 2 to 500 characters',
	                'allowEmpty' => true
	            )
			)
		);
	}