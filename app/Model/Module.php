<?php 
class Module extends AppModel {
	
	public $validate = array();
	
	public $hasMany = array('Privilege');
	
}