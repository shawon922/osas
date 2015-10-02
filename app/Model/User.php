<?php
	class User extends AppModel
	{
		public $validate = array(
			'username' => array(
				'rule' => array(
					'notEmpty' => true,
					'message' => 'Username is required.'
				)
			),
		);
	}