<?php
	class HomesController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
        	$this->Auth->allow(array('index'));		
	    }

	    public function index() {

	    	$title_for_layout = 'Home Page';
	    	
	    	$this->set(compact(array('title_for_layout')));
	    }	    
	}