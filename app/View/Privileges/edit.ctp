<h3><?php echo __('Edit Privilege'); ?></h3>
<div class="ministries form well">
<?php echo $this->Form->create('Privilege', array( 'role' => 'form', 'inputDefaults' => array( 'div' => 'form-group' ) )); ?>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('ministry_code', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		echo $this->Form->input('ministry_code_imed', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		echo $this->Form->input('ministry_edesc', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		echo $this->Form->input('ministry_bdesc', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		echo $this->Form->input('entered_by', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		//echo $this->Form->input('entry_date');
		echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-primary'));
	?>
<?php echo $this->Form->end(); ?>
</div>
<?php /*
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Privilege.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Ministry.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Ministries'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Executing Agencies'), array('controller' => 'executing_agencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Executing Agency'), array('controller' => 'executing_agencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
*/?>
