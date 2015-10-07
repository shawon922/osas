<?php
	class User extends AppModel
	{
		public $hasMany = array();
		public $belongsTo = array();

		public $validate = array(
			'username' => array(
				'rule' => array(
					'notEmpty' => true,
					'message' => 'Username is required.'
				)
			),
		);
	}