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
	    	$this->set('title_for_layout', $title_for_layout);

	    	//pr($this->request->data);

	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['User']['created_by'] = $this->userInfo['id']; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['User']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['User']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['User']['status'] = 1; 


	    			//checking password and confirm_password.

	    			if ($this->request->data['User']['password'] !== $this->request->data['User']['confirm_password']) {
	    				$this->Session->setFlash('Password and confirm password don\'t match.', 'default', array('class' => 'alert alert-danger'));

	    				return false;
	    			} else {
	    				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
	    			}

	    			

	    			if ($this->User->save($this->request->data)) {
	    				$this->Session->setFlash('User has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'users', 'action' => 'index'));
	    			} else {
	    				unset($this->request->data['User']['password']);
	    				unset($this->request->data['User']['confirm_password']);
	    				$this->Session->setFlash('User could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}
	    }


	    public function edit($id) {
	    	$title_for_layout = 'Edit User Information';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is(array('post', 'put'))) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//It's important to assign primary key into array
	    			$this->request->data['User']['id'] = $id; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['User']['modified_by'] = $this->userInfo['id']; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['User']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['User']['status'] = 1; 


	    			//checking password and confirm_password.
	    			if (!empty($this->request->data['User']['password']) && !empty($this->request->data['User']['confirm_password'])) {
	    				if ($this->request->data['User']['password'] !== $this->request->data['User']['confirm_password']) {
		    				$this->Session->setFlash('Password and confirm password don\'t match.', 'default', array('class' => 'alert alert-danger'));

		    				return false;
		    			} else {
		    				$this->request->data['User']['password'] = $this->Auth->password($this->request->data['User']['password']);
		    			}
	    			} else {
	    				unset($this->request->data['User']['password']);
	    			}
	    			

	    			

	    			if ($this->User->save($this->request->data)) {
	    				$this->Session->setFlash('User has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'users', 'action' => 'index'));
	    			} else {
	    				unset($this->request->data['User']['password']);
	    				unset($this->request->data['User']['confirm_password']);
	    				$this->Session->setFlash('User could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$this->request->data = $this->User->find('first', array('conditions' => array('User.id' => $id, 'User.status' => 1)));
	    	unset($this->request->data['User']['password']);
	    }


	    public function changeStatus($id, $status) {
	    	$this->User->id = $id;

	    	if ( $this->User->saveField('status', $status) ) {
	    		$this->Session->setFlash('User has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'users', 'action' => 'index'));
	    	}
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
	    	$this->Session->destroy();
	    	$this->Cookie->destroy();
	    	$this->remove_all_cookies();

	    	return $this->redirect($this->Auth->logout());
	    }
	}