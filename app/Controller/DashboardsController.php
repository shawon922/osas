<?php

	class DashboardsController extends AppController
	{
		public function index()
		{
			$title_for_layout = 'Dashboard';
            $this->set('title_for_layout', $title_for_layout);
		}
	}