<?php

	class DashboardsController extends AppController
	{
		public $uses = array('User');

		public function index()
		{
			$title_for_layout = 'Dashboard';
			$messages = $this->User->find('all', array('conditions' => array('User.status' => 1), 'fields' => array('User.first_name', 'User.last_name', 'User.email', 'User.created'), 'order' => array('User.created DESC')));
            //pr($messages); die;
            $this->set(compact('title_for_layout', 'messages'));
		}
	}