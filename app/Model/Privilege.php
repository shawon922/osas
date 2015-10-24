<?php
App::uses('AppModel', 'Model');

class Privilege extends AppModel {

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	public $belongsTo = array(
        'Role' => array(
            'className' => 'Role',
            'foreignKey' => 'role_id'
        ),
		'Module' => array(
            'className' => 'Module',
            'foreignKey' => 'module_id'
        )
    );
	
}
