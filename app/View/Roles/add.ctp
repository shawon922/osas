<h4 class="widgettitle"><?php echo $title_for_layout; ?></h4>
<div class="widgetcontent bordered shadowed nopadding">
	<?php  
		echo $this->Form->create('Role', array( 'role' => 'form', 'class' => 'stdform stdform2' ) ); 
		echo $this->Form->input( 'name', array( 'autocomplete' => 'off', 'required'=> false, 'label'=> array( 'text'=>'নাম*', 'class'=>'rad_star' ) )); 
		echo $this->Form->input( 'name_en', array( 'autocomplete' => 'off', 'required'=> false, 'label'=> array( 'text'=>'Name*', 'class'=>'rad_star' )  ) ); 
		
		echo '<p class="stdformbutton">';
		echo $this->Form->button(($lang == 1) ? 'সংরক্ষণ করুন ' : 'Save', array('type' => 'submit', 'class' => 'btn btn-primary'));
		echo $this->Form->button(($lang == 1) ? 'রিসেট' : 'Reset', array('type' => 'reset', 'class' => 'btn btn-primary margin-left-5'));
		echo $this->Form->button(($lang == 1) ? 'বন্ধ করুন ' : 'Cancel', array('type' => 'button', 'class' => 'btn btn-primary margin-left-5','onclick'=>'cancel(\'Roles\')'));
		
		echo '</p>';
		echo $this->Form->end(); 
	?>
</div>
