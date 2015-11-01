<?php
	class HomesController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();			
	    }

	    public function index() {

	    	$title_for_layout = 'Home Page';
	    	
	    	$this->set(compact(array('title_for_layout')));
	    }

	    
	}