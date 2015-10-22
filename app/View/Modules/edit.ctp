<h4 class="widgettitle"><?php echo $title_for_layout; ?></h4>
<!--<div id="basic">-->
	<div class="widgetcontent bordered shadowed nopadding">
		<?php 
			$lang = $this->Session->read('lang');
			echo $this->Form->create('Module', array( 'role' => 'form', 'class' => 'stdform stdform2')); 
			echo $this->Form->input('parent_id', array('empty'=> ($lang==1) ? '---  নির্বাচন করুন ---' : '---Select One---' , 'label'=> ($lang==1) ? 'প্যারেন্ট মডিউল ' :'Parent Module', 'options'=>$modules ) );
			echo $this->Form->input('name', array('required'=>false, 'placeholder'=>'মডিউল', 'label'=> array('text'=>' মডিউল* ', 'class' => 'rad_star') ) ); 
			echo $this->Form->input('name_en', array('required'=>false, 'placeholder'=>'Module', 'label'=>array('text'=> 'Module*', 'class' => 'rad_star') ) ); 
			
			echo '<p class="stdformbutton">';
			echo $this->Form->button(($lang==1) ? ' পরিবর্তন করুন' :'Update', array('type' => 'submit', 'class' => 'btn btn-primary'));
			echo $this->Form->button(($lang==1) ? ' বন্ধ করুন ' : 'Cancel', array('type' => 'button', 'class' => 'btn btn-primary margin-left-5','onclick'=>'cancel(\'Modules\')'));
			//echo $this->Form->button(($lang==1) ? 'রিসেট' : 'Reset', array('type' => 'reset', 'class' => 'btn btn-primary margin-left-5'));
			echo '</p>';
			echo $this->Form->end(); 
		?>
	</div>
<!--</div>-->