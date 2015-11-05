<?php

	class DashboardsController extends AppController
	{
		public $uses = array('User');

		public function index()
		{
			$title_for_layout = 'Dashboard';			
            //pr($messages); die;
            $this->set(compact('title_for_layout'));
		}
	}