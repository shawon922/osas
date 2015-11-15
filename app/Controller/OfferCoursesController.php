<?php
	class OfferCoursesController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
			
	    }

	    public function index() {
	    	$title_for_layout = 'Course List';

	    	$this->set(compact('title_for_layout', 'courses'));
	    }

	    public function add() {
	    	$title_for_layout = 'Offer New Course';
	    	$this->set('title_for_layout', $title_for_layout);

	    	//pr($this->request->data);

	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) { 
	    		pr($this->request->data); die;
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//get user's id from $userInfo array
	    			$this->request->data['Course']['created_by'] = $this->userInfo['id']; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Course']['modified_by'] = 0; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Course']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Course']['status'] = 1; 
 			

	    			if ($this->Course->save($this->request->data)) {
	    				$this->Session->setFlash('Course has been saved successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'courses', 'action' => 'index'));
	    			} else {	    				
	    				$this->Session->setFlash('Course could not be saved. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$temp_courses = $this->Course->find('all', array('conditions' => array('Course.status' => 1, 'Course.department_id' => $this->userInfo['department_id']), 'fields' => array('Course.id', 'Course.code', 'Course.name')));

	    	$courses = array();

	    	if (!empty($temp_courses)) {

	    		foreach ($temp_courses as $temp_course) {
	    			$courses[$temp_course['Course']['id']] = $temp_course['Course']['code'].'-'.$temp_course['Course']['name'];
	    		}
	    	}


	    	$temp_teachers = $this->User->find('all', array('conditions' => array('User.status' => 1, 'User.department_id' => $this->userInfo['department_id'], 'User.role_id' => 2)));

	    	
	    	$teachers = array();

	    	if (!empty($temp_teachers)) {

	    		foreach ($temp_teachers as $temp_teacher) {
	    			$teachers[$temp_teacher['User']['id']] = $temp_teacher['Employee']['first_name'].' '.$temp_teacher['Employee']['last_name'].'('.$temp_teacher['Employee']['employee_code'].')';
	    		}
	    	}


	    	$this->set(compact('courses', 'teachers'));
	    }


	    public function edit($id) {
	    	$title_for_layout = 'Edit Course Information';
	    	$this->set('title_for_layout', $title_for_layout);

	    	
	    	//Checking the request is 'post' or not
	    	if ($this->request->is(array('post', 'put'))) {
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {
	    			//Set value for common columns

	    			//It's important to assign primary key into array
	    			$this->request->data['Course']['id'] = $id; 

	    			//First time 'modified_by' is 0 (zero)
	    			$this->request->data['Course']['modified_by'] = $this->userInfo['id']; 

	    			//get IP address of user's pc. Method is available in AppController class
	    			$this->request->data['Course']['terminal'] = $this->getClientIp(); 

	    			//set status. By default 1
	    			$this->request->data['Course']['status'] = 1; 


	    			if ($this->Course->save($this->request->data)) {
	    				$this->Session->setFlash('Course has been savedupdated successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'courses', 'action' => 'index'));
	    			} else {
	    				
	    				$this->Session->setFlash('Course could not be updated. Try again.', 'default', array('class' => 'alert alert-danger'));
	    			}	    			
	    		}
	    	}

	    	$this->request->data = $this->Course->find('first', array('conditions' => array('Course.id' => $id, 'Course.status' => 1)));
	    }


	    public function changeStatus($id, $status) {
	    	$this->Course->id = $id;

	    	if ( $this->Course->saveField('status', $status) ) {
	    		$this->Session->setFlash('Course has been removed successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    		$this->redirect(array('controller' => 'courses', 'action' => 'index'));
	    	}
	    }


	    public function addOfferCourseTr($i = null)
	    {
	    	$temp_courses = $this->Course->find('all', array('conditions' => array('Course.status' => 1, 'Course.department_id' => $this->userInfo['department_id']), 'fields' => array('Course.id', 'Course.code', 'Course.name')));

	    	$courses = array();

	    	if (!empty($temp_courses)) {

	    		foreach ($temp_courses as $temp_course) {
	    			$courses[$temp_course['Course']['id']] = $temp_course['Course']['code'].'-'.$temp_course['Course']['name'];
	    		}
	    	}


	    	$temp_teachers = $this->User->find('all', array('conditions' => array('User.status' => 1, 'User.department_id' => $this->userInfo['department_id'], 'User.role_id' => 2)));

	    	
	    	$teachers = array();

	    	if (!empty($temp_teachers)) {

	    		foreach ($temp_teachers as $temp_teacher) {
	    			$teachers[$temp_teacher['User']['id']] = $temp_teacher['Employee']['first_name'].' '.$temp_teacher['Employee']['last_name'].'('.$temp_teacher['Employee']['employee_code'].')';
	    		}
	    	}


	    	$this->set(compact('courses', 'teachers', 'i'));
	    }

	}