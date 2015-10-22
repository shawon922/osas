<?php
	class DesignationsController extends AppController
	{
		

		function beforeFilter() {

	        parent::beforeFilter();			
	    }

	    public function index() {

	    	$designations = $this->Designation->find('all', array('conditions' => array('Designation.status' => 1)));

	    	$title_for_layout = 'Designation List';

	    	$this->set(compact(array('title_for_layout', 'designations')));
	    }

	    public function add() {
	    	$title_for_layout = 'Add New Designation';
	    	$this->set('title_for_layout', $title_for_layout);

	    	//pr($this->request->data);

	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['Designation']['created_by'] = $this->userInfo['id']; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Designation']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Designation']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Designation']['status'] = 1; 
 			

	    			if ($this->Designation->save($this->request->data)) {
	    				$this->Session->setFlash('Designation has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'designations', 'action' => 'index'));
	    			} else {	    				
	    				$this->Session->setFlash('Designation could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}
	    }


	    public function edit($id) {
	    	$title_for_layout = 'Edit Designation Information';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is(array('post', 'put'))) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//It's important to assign primary key into array
	    			$this->request->data['Designation']['id'] = $id; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Designation']['modified_by'] = $this->userInfo['id']; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Designation']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Designation']['status'] = 1; 


	    			if ($this->Designation->save($this->request->data)) {
	    				$this->Session->setFlash('Designation has been updated successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'designations', 'action' => 'index'));
	    			} else {
	    				
	    				$this->Session->setFlash('Designation could not be updated. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$this->request->data = $this->Designation->find('first', array('conditions' => array('Designation.id' => $id, 'Designation.status' => 1)));
	    }


	    public function changeStatus($id, $status) {
	    	$this->Designation->id = $id;

	    	if ( $this->Designation->saveField('status', $status) ) {
	    		$this->Session->setFlash('Designation has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'designations', 'action' => 'index'));
	    	}
	    }

	}