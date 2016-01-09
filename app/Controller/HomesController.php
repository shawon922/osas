<?php
	class HomesController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
        	$this->Auth->allow(array('index'));		
	    }

	    public function index() {

	    	$title_for_layout = 'Home Page';
	    	$departments = $this->Department->find('list', array('conditions' => array('Department.status' => 1), 'fields' => array('Department.id', 'Department.name')));

	    	$this->set(compact(array('title_for_layout', 'departments')));
	    }	    
	}