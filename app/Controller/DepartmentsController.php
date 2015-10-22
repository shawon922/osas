<?php
	class DepartmentsController extends AppController
	{
		

		function beforeFilter() {

	        parent::beforeFilter();			
	    }

	    public function index() {

	    	$departments = $this->Department->find('all', array('conditions' => array('Department.status' => 1)));

	    	$title_for_layout = 'Department List';

	    	$this->set(compact(array('title_for_layout', 'departments')));
	    }

	    public function add() {
	    	$title_for_layout = 'Add New Department';
	    	$this->set('title_for_layout', $title_for_layout);

	    	//pr($this->request->data);

	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['Department']['created_by'] = $this->userInfo['id']; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Department']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Department']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Department']['status'] = 1; 
 			

	    			if ($this->Department->save($this->request->data)) {
	    				$this->Session->setFlash('Department has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'departments', 'action' => 'index'));
	    			} else {	    				
	    				$this->Session->setFlash('Department could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}
	    }


	    public function edit($id) {
	    	$title_for_layout = 'Edit Department Information';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is(array('post', 'put'))) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//It's important to assign primary key into array
	    			$this->request->data['Department']['id'] = $id; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Department']['modified_by'] = $this->userInfo['id']; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Department']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Department']['status'] = 1; 


	    			if ($this->Department->save($this->request->data)) {
	    				$this->Session->setFlash('Department has been updated successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'departments', 'action' => 'index'));
	    			} else {
	    				
	    				$this->Session->setFlash('Department could not be updated. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$this->request->data = $this->Department->find('first', array('conditions' => array('Department.id' => $id, 'Department.status' => 1)));
	    }


	    public function changeStatus($id, $status) {
	    	$this->Department->id = $id;

	    	if ( $this->Department->saveField('status', $status) ) {
	    		$this->Session->setFlash('Department has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'departments', 'action' => 'index'));
	    	}
	    }

	}