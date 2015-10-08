<?php
	class UsersController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
			
	    }

	    public function index() {

	    	$users = $this->User->find('all', array('conditions' => array('User.status' => 1)));

	    	$title_for_layout = 'User List';

	    	$this->set(compact(array('title_for_layout', 'users')));
	    }

	    public function add() {

	    	$title_for_layout = 'Add New User';

	    	$this->set(compact(array('title_for_layout')));
	    }


		public function login() {

	        $this->layout = 'login';

	        if ($this->Auth->loggedIn()) {
	        	return $this->redirect($this->Auth->redirect()); 
	        }

	        if( $this->request->isPost() ) {

	            if ( $this->Auth->login() ) {
					$this->Cookie->destroy();
	                $this->redirect($this->Auth->redirect()); 
	            } else {
	                $this->Session->setFlash('Invalid username or password', 'default', array( 'class' => 'alert alert-danger' ) );
	            }

	        }

	        $this->remove_all_cookies();
	        $this->set('title_for_layout', 'OSAS - LogIn' );  
	    }


	    public function logout() {
	    	return $this->redirect($this->Auth->logout());
	    }
	}