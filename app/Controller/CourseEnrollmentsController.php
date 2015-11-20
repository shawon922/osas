<?php
	class CourseEnrollmentsController extends AppController
	{

		function beforeFilter() {
	        parent::beforeFilter();
			
	    }

	    public function index() {
	    	$title_for_layout = 'Offered Course List';

	    	$offered_courses = $this->OfferCourse->find('all', array('recursive' => 1, 'conditions' => array('OfferCourse.status' => 1, 'OfferCourse.semester' => 1, 'OfferCourse.year' => date('Y')), 'order' => array('OfferCourse.user_id')));

	    	pr($offered_courses); die;

	    	$this->request->data['OfferCourse']['semester'] = 1;
	    	$this->request->data['OfferCourse']['year'] = 1;

	    	$this->set(compact('title_for_layout', 'offered_courses'));
	    }

	    public function add() {
	    	$years = Configure::read('semester_year');

	    	$title_for_layout = 'Offer New Course';
	    	$this->set('title_for_layout', $title_for_layout);

	    	//pr($this->request->data);

	    	//Checking the request is 'post' or not
	    	if ($this->request->is('post')) { 
	    		//pr($this->request->data); //die;
	    		//Checking $this->request->data is empty or not
	    		if (!empty($this->request->data)) {

	    			$data = $this->request->data;


	    			//assign semester, year into variables and unset those from $data
	    			$temp_semester = $data['OfferCourse']['semester'];
	    			unset($data['OfferCourse']['semester']);

	    			$temp_year = $years[$data['OfferCourse']['year']];
	    			unset($data['OfferCourse']['year']);

	    			//pr($data); //die;
	    			

	    			$temp_data = array();

	    			if (!empty($data['OfferCourse'])) {
	    				foreach ($data['OfferCourse'] as $key => $dt) { 

	    					$temp_data['OfferCourse'][$key]['course_id'] = $dt['course_id'];
	    					$temp_data['OfferCourse'][$key]['user_id'] = $dt['user_id'];
	    					$temp_data['OfferCourse'][$key]['created_by'] = $this->userInfo['id'];
	    					$temp_data['OfferCourse'][$key]['modified_by'] = 0;
	    					$temp_data['OfferCourse'][$key]['terminal'] = $this->getClientIp();
	    					$temp_data['OfferCourse'][$key]['status'] = 1;
	    					$temp_data['OfferCourse'][$key]['semester'] = $temp_semester;
	    					$temp_data['OfferCourse'][$key]['year'] = $temp_year;
	    					$temp_data['OfferCourse'][$key]['department_id'] = $this->userInfo['department_id'];	    					
	    				}
	    			}

	    			if ($data['OfferCourseChild']) {
	    				foreach ($data['OfferCourseChild'] as $outer_key => $batch_data) {
	    					
	    					foreach ($batch_data['batch'] as $inner_key => $value) {
	    						$temp_data['OfferCourse'][$outer_key]['OfferCourseChild'][$inner_key]['batch'] = $value;
	    						$temp_data['OfferCourse'][$outer_key]['OfferCourseChild'][$inner_key]['status'] = 1;
	    						$temp_data['OfferCourse'][$outer_key]['OfferCourseChild'][$inner_key]['created_by'] = $this->userInfo['id'];
	    						$temp_data['OfferCourse'][$outer_key]['OfferCourseChild'][$inner_key]['modified_by'] = 0;
	    						$temp_data['OfferCourse'][$outer_key]['OfferCourseChild'][$inner_key]['terminal'] = $this->getClientIP();
	    					}
	    				}
	    			}

	    			pr($temp_data); //die;
 			

	    			if ($this->OfferCourse->saveAll($temp_data['OfferCourse'], array('deep' => true))) {
	    				$this->Session->setFlash('New course has been offered successfully. Thank you.', 'default', array('class' => 'alert alert-success'));
	    				$this->redirect(array('controller' => 'offer_courses', 'action' => 'index'));
	    			} else {	    				
	    				$this->Session->setFlash('New course could not be offered. Try again.', 'default', array('class' => 'alert alert-danger'));
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