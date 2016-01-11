<?php
	class HomesController extends AppController
	{
		

		function beforeFilter() {
	        parent::beforeFilter();
        	$this->Auth->allow(array('index'));

        	$authUser = $this->Auth->user();

        	$this->set(compact('authUser'));
	    }

	    public function index() {

	    	$title_for_layout = 'Home Page';
	    	$departments = $this->Department->find('list', array('conditions' => array('Department.status' => 1), 'fields' => array('Department.id', 'Department.name')));

	    	if ($this->request->is(array('post', 'put'))) {
	    		if (!empty($this->request->data['Department']['id'])) {
	    			$deptId = $this->request->data['Department']['id'];

	    			if ($this->Department->exists($deptId)) {
	    				$this->Session->write('DEPT_ID', $deptId);

	    				$this->redirect(array('controller' => 'dashboards', 'action' => 'index'));
	    			}
	    		}
	    	}

	    	$this->set(compact('title_for_layout', 'departments'));
	    }	    
	}