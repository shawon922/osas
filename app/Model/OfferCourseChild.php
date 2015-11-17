<?php
	class OfferCourseChild extends AppModel
	{
		public $hasMany = array();
		public $belongsTo = array('OfferCourse');

		public $validate = array();
	}