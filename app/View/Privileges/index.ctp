<h3><?php echo __('Privileges'); ?> <?php echo $this->Html->link( 'Add New', array( 'action' => 'add' ), array( 'class' => 'btn btn-xs btn-primary' ) ) ?></h3>
<div class="table-responsive">
	<table class="table table-hover table-bordered" cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('ministry_code'); ?></th>
			<th><?php echo $this->Paginator->sort('ministry_code_imed'); ?></th>
			<th><?php echo $this->Paginator->sort('ministry_edesc'); ?></th>
			<th><?php echo $this->Paginator->sort('ministry_bdesc'); ?></th>
			<th><?php echo $this->Paginator->sort('entered_by'); ?></th>
			<th><?php echo $this->Paginator->sort('entry_date'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($privileges as $privilege): ?>
	<tr>
		<td><?php echo h($privilege['Privilege']['id']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['ministry_code']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['ministry_code_imed']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['ministry_edesc']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['ministry_bdesc']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['entered_by']); ?>&nbsp;</td>
		<td><?php echo h($privilege['Privilege']['entry_date']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $privilege['Privilege']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $privilege['Privilege']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $privilege['Privilege']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $privilege['Privilege']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<?php echo $this->element('pagination') ;?>
</div>
<?php /*
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ministry'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Executing Agencies'), array('controller' => 'executing_agencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Executing Agency'), array('controller' => 'executing_agencies', 'action' => 'add')); ?> </li>
	</ul>
</div>*/?>
