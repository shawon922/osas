
	<div class="row pull-right">
        
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> New Module', array('controller' => 'modules', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Click here to add new module',  'escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'top') ); 
        ?>
    </div>
	<table class="table table-bordered table-responsive">
		<colgroup>
	    	<col class="con0" style="width: 10%"/>
	    	<col class="con1" style="width: 25%"/>
	        <col class="con0" style="width: 25%"/>
	        <col class="con1" style="width: 15%"/>
		</colgroup>
	    <thead>
			
		    <tr>
		    	<th class="head0" style="text-align:center"> <?php echo 'SL.'; ?>  </th>
	            <th class="head1" style="text-align:center"> <?php echo 'Parent Module'; ?>  </th>
	            <th class="head0" style="text-align:center"> <?php echo 'Module'; ?> </th>
	            
		        <th class="head1"  style="text-align:center">Action</th>
		        
		    </tr>
		</thead>
		<tbody>
		<?php 
			if (!empty($modules)) { 
				$i = 1;
			foreach ($modules as $module) { ?>
			<tr>
				<td><?php echo $i++; ?></td>
				<td>
					<?php 
						if($module['Module']['parent_id'] != 0) { 
							echo $modulesArr[$module['Module']['parent_id']];
						} else { 
							echo '--';
						} 
					?>
				</td>
		        <td><?php echo h($module['Module']['name']); ?></td>
				<td class="actions">
					<?php 
		                echo $this->Html->link( '<i class="fa fa-pencil"></i> Edit', array('controller' => 'modules', 'action' => 'edit', $module['Module']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

		                echo ' ';

		                echo $this->Form->postLink( '<i class="fa fa-times"></i> Remove', array('controller' => 'modules', 'action' => 'changeStatus', $module['Module']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

		               ?>
				</td>
			</tr>
	<?php } } else { ?>
			<tr>
				<td colspan="3" class="text-center">No Module Found.</td>
			</tr>
	<?php } ?>

		</tbody>
	</table>
<?php echo $this->element('pagination') ;?>

