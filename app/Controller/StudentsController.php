<?php
	class StudentsController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
			$this->Auth->allow(array('register'));	
	    }

	    public function index() {

	    	$employees = $this->Employee->find('all', array('conditions' => array('Employee.status' => 1)));

	    	$title_for_layout = 'Employee List';

	    	$this->set(compact(array('title_for_layout', 'employees')));
	    }

	    public function register() {
	    	$title_for_layout = 'Student Registration';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['Student']['created_by'] = 0;
	    			$this->request->data['User']['created_by'] = 0;

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Student']['modified_by'] = 0; 
	    			$this->request->data['User']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Student']['terminal'] = $this->getClientIp(); 
	    			$this->request->data['User']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Student']['status'] = 1; 
	    			$this->request->data['User']['status'] = 1; 

	    			//converting date format to integer
	    			$this->request->data['Student']['date_of_birth'] = strtotime($this->request->data['Student']['date_of_birth']);
	    			$this->request->data['Student']['date_of_admission'] = strtotime($this->request->data['Student']['date_of_admission']);


	    			
	    			$this->request->data['User']['first_name'] = $this->request->data['Student']['first_name'];
	    			$this->request->data['User']['last_name'] = $this->request->data['Student']['last_name'];
	    			

	    			
	    			//username is generated from email and password is from contact_no
	    			$this->request->data['User']['username'] = $this->request->data['Student']['id_no'];
	    			$this->request->data['User']['password'] = $this->Auth->password($this->request->data['Student']['id_no']);

	    			$this->request->data['User']['department_id'] = $this->request->data['Student']['department_id'];
	    			$this->request->data['User']['employee_id'] = 0;
	    			$this->request->data['User']['role_id'] = 3;
	    			$this->request->data['User']['contact_no'] = $this->request->data['Student']['contact_no'];
	    			$this->request->data['User']['email'] = $this->request->data['Student']['email'];
	    			$this->request->data['User']['address'] = $this->request->data['Student']['address'];

	    			
	    			
	    			//pr($this->request->data); die;

	    			if ($this->Student->saveAssociated($this->request->data)) {
	    				$this->Session->setFlash('Registration has been completed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => '/', 'action' => 'login'));
	    			} else {

	    				//converting integer to date format 
	    				$this->request->data['Student']['date_of_birth'] = date('d-m-Y', $this->request->data['Student']['date_of_birth']);
	    				$this->request->data['Student']['date_of_admission'] = date('d-m-Y', $this->request->data['Student']['date_of_admission']);

	    				$this->Session->setFlash('Student could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$departments = $this->Department->find('list', array('conditions' => array('Department.status' => 1), 'fields' => array('Department.name')));

	    	$this->set(compact('departments'));
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
	    			$this->request->data['Employee']['date_of_admission'] = strtotime($this->request->data['Employee']['date_of_admission']);


	    			

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
	    	$this->request->data['Employee']['date_of_admission'] = date('d-m-Y', $this->request->data['Employee']['date_of_admission']);
	    }


	    public function changeStatus($id, $status) {
	    	$this->Employee->id = $id;

	    	if ( $this->Employee->saveField('status', $status) ) {
	    		$this->Session->setFlash('Employee has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'employees', 'action' => 'index'));
	    	}
	    }

	}