<?php
	class StudentsController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
			
	    }

	    public function index() {

	    	$employees = $this->Employee->find('all', array('conditions' => array('Employee.status' => 1)));

	    	$title_for_layout = 'Employee List';

	    	$this->set(compact(array('title_for_layout', 'employees')));
	    }

	    public function register() {
	    	$title_for_layout = 'Add New Employee';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['Employee']['created_by'] = $this->userInfo['id'];
	    			$this->request->data['User']['created_by'] = $this->userInfo['id'];

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Employee']['modified_by'] = 0; 
	    			$this->request->data['User']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Employee']['terminal'] = $this->getClientIp(); 
	    			$this->request->data['User']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Employee']['status'] = 1; 
	    			$this->request->data['User']['status'] = 1; 

	    			//converting date format to integer
	    			$this->request->data['Employee']['date_of_birth'] = strtotime($this->request->data['Employee']['date_of_birth']);
	    			$this->request->data['Employee']['date_of_joining'] = strtotime($this->request->data['Employee']['date_of_joining']);


	    			
	    			$this->request->data['User']['first_name'] = $this->request->data['Employee']['first_name'];
	    			$this->request->data['User']['last_name'] = $this->request->data['Employee']['last_name'];
	    			$this->request->data['User']['designation_id'] = $this->request->data['Employee']['designation_id'];

	    			$exp_email = explode('@', $this->request->data['Employee']['email']);

	    			//username is generated from email and password is from contact_no
	    			$this->request->data['User']['username'] = $exp_email[0].$this->request->data['Employee']['contact_no'];
	    			$this->request->data['User']['password'] = $this->Auth->password($this->request->data['Employee']['contact_no']);


	    			$this->request->data['User']['student_id'] = 0;
	    			$this->request->data['User']['role_id'] = 0;
	    			$this->request->data['User']['contact_no'] = $this->request->data['Employee']['contact_no'];
	    			$this->request->data['User']['email'] = $this->request->data['Employee']['email'];
	    			$this->request->data['User']['address'] = $this->request->data['Employee']['address'];

	    			
	    			
	    			//pr($this->request->data); die;

	    			if ($this->Employee->saveAssociated($this->request->data)) {
	    				$this->Session->setFlash('Employee has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'employees', 'action' => 'index'));
	    			} else {

	    				//converting integer to date format 
	    				$this->request->data['Employee']['date_of_birth'] = date('d-m-Y', $this->request->data['Employee']['date_of_birth']);
	    				$this->request->data['Employee']['date_of_joining'] = date('d-m-Y', $this->request->data['Employee']['date_of_joining']);

	    				$this->Session->setFlash('Employee could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}
	    }


	    public function edit($id) {
	    	$title_for_layout = 'Edit Employee Information';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is(array('post', 'put'))) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//It's important to assign primary key into array
	    			$this->request->data['Employee']['id'] = $id; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Employee']['modified_by'] = $this->userInfo['id']; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Employee']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Employee']['status'] = 1; 

	    			//converting date format to integer
	    			$this->request->data['Employee']['date_of_birth'] = strtotime($this->request->data['Employee']['date_of_birth']);
	    			$this->request->data['Employee']['date_of_joining'] = strtotime($this->request->data['Employee']['date_of_joining']);


	    			

	    			if ($this->Employee->save($this->request->data)) {
	    				$this->Session->setFlash('Employee has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'employees', 'action' => 'index'));
	    			} else {
	    				
	    				$this->Session->setFlash('Employee could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$this->request->data = $this->Employee->find('first', array('conditions' => array('Employee.id' => $id, 'Employee.status' => 1)));


	    	//converting integer to date format
	    	$this->request->data['Employee']['date_of_birth'] = date('d-m-Y', $this->request->data['Employee']['date_of_birth']);
	    	$this->request->data['Employee']['date_of_joining'] = date('d-m-Y', $this->request->data['Employee']['date_of_joining']);
	    }


	    public function changeStatus($id, $status) {
	    	$this->Employee->id = $id;

	    	if ( $this->Employee->saveField('status', $status) ) {
	    		$this->Session->setFlash('Employee has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'employees', 'action' => 'index'));
	    	}
	    }

	}