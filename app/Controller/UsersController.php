<?php
	class UsersController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
			
	    }


		public function login() {
	        $this->layout = 'login';

	        if( $this->request->isPost() ) {
	            if ( $this->Auth->login() ) {
					$this->Cookie->destroy();
					//$this->loginInfo($this->Session->read('Auth.User.id'));
	                $this->redirect($this->Auth->redirect()); 
	            } else {
	                $this->Session->setFlash('Invalid username or password', 'default', array( 'class' => 'alert alert-danger' ) );
	            }
	        }

	        $this->remove_all_cookies();
	        $this->set('title_for_layout', 'OSAS - LogIn' );  
	    }
	}