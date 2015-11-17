<?php
	class OfferCourse extends AppModel
	{
		public $hasMany = array('OfferCourseChild');
		public $belongsTo = array('Course', 'User', 'Department');

		public $validate = array();
	}