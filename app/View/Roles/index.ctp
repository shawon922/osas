<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>

	<div class="row pull-right">
        
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> New Role', array('controller' => 'roles', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Click here to add new role',  'escape' => false, 'data-toggle' => 'tooltip', 'data-placement' => 'top') ); 
        ?>
    </div>
	<table class="table table-bordered table-responsive" id="role-list">
		<colgroup>
	    	<col class="con0" style="width: 10%"/>
	        <col class="con0" style="width: 45%"/>
	        <col class="con1" style="width: 30%"/>
		</colgroup>
	    <thead>
			
		    <tr>
		    	<th class="head0" style="text-align:center"> <?php echo 'SL.'; ?>  </th>
	            <th class="head0" style="text-align:center"> <?php echo 'Role'; ?> </th>
	            
		        <th class="head1"  style="text-align:center">Action</th>
		        
		    </tr>
		</thead>
		<tbody>
		<?php 
			if (!empty($roles)) { 
				$i = 1;
			foreach ($roles as $role) { ?>
			<tr>
				<td><?php echo $i++; ?></td>
				
		        <td><?php echo h($role['Role']['name']); ?></td>
				<td class="actions">
					<?php 
		                echo $this->Html->link( '<i class="fa fa-pencil"></i> Edit', array('controller' => 'roles', 'action' => 'edit', $role['Role']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

		                echo ' ';

		                echo $this->Form->postLink( '<i class="fa fa-times"></i> Remove', array('controller' => 'roles', 'action' => 'changeStatus', $role['Role']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

		               ?>
				</td>
			</tr>
	<?php } } ?>

		</tbody>
	</table>


<script type="text/javascript">
    $(document).ready(function(){
        $('#role-list').DataTable();
    });
</script>

