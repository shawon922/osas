<h3><?php echo __('Ministry'); ?></h3>
<div class="ministries view well">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ministry Code'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['ministry_code']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ministry Code Imed'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['ministry_code_imed']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ministry Edesc'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['ministry_edesc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ministry Bdesc'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['ministry_bdesc']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entered By'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['entered_by']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Entry Date'); ?></dt>
		<dd>
			<?php echo h($ministry['Ministry']['entry_date']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<?php /*
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ministry'), array('action' => 'edit', $ministry['Ministry']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ministry'), array('action' => 'delete', $ministry['Ministry']['id']), array(), __('Are you sure you want to delete # %s?', $ministry['Ministry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ministries'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ministry'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Executing Agencies'), array('controller' => 'executing_agencies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Executing Agency'), array('controller' => 'executing_agencies', 'action' => 'add')); ?> </li>
	</ul>
</div>
*/?>
<div class="related table-responsive">
	<h3><?php echo __('Related Executing Agencies'); ?></h3>
	<?php if (!empty($ministry['ExecutingAgency'])): ?>
	<table class="table table-hover table-bordered" cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Ministry Id'); ?></th>
		<th><?php echo __('Function Code'); ?></th>
		<th><?php echo __('Ea Ext'); ?></th>
		<th><?php echo __('Imed Code'); ?></th>
		<th><?php echo __('Ministry Edesc'); ?></th>
		<th><?php echo __('Ea Edesc'); ?></th>
		<th><?php echo __('Ea Bdesc'); ?></th>
		<th><?php echo __('Entered By'); ?></th>
		<th><?php echo __('Entry Date'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ministry['ExecutingAgency'] as $executingAgency): ?>
		<tr>
			<td><?php echo $executingAgency['id']; ?></td>
			<td><?php echo $executingAgency['ministry_id']; ?></td>
			<td><?php echo $executingAgency['function_code']; ?></td>
			<td><?php echo $executingAgency['ea_ext']; ?></td>
			<td><?php echo $executingAgency['imed_code']; ?></td>
			<td><?php echo $executingAgency['ministry_edesc']; ?></td>
			<td><?php echo $executingAgency['ea_edesc']; ?></td>
			<td><?php echo $executingAgency['ea_bdesc']; ?></td>
			<td><?php echo $executingAgency['entered_by']; ?></td>
			<td><?php echo $executingAgency['entry_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'executing_agencies', 'action' => 'view', $executingAgency['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'executing_agencies', 'action' => 'edit', $executingAgency['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'executing_agencies', 'action' => 'delete', $executingAgency['id']), array(), __('Are you sure you want to delete # %s?', $executingAgency['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

<?php /*
	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Executing Agency'), array('controller' => 'executing_agencies', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
*/?>
