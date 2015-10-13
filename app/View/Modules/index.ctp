<?php 
	$lang = $this->Session->read('lang'); 
	$status_en = Configure::read("status_en");
	$status = Configure::read("status");
?>
<h4 class="widgettitle"><?php echo $title_for_layout ?> </h4>
<div class="table-responsive dataTables_wrapper">
	<table class="table table-bordered">
	<colgroup>
    	<col class="con1" style="align: center; width: 25%"/>
        <col class="con0" style="align: center; width: 25%"/>
        <col class="con1" style="align: center; width: 25%"/>
        <col class="con0" style="align: center; width: 25%"/>
	</colgroup>
    <thead>
		
	    <tr>
            <th class="head0" style="text-align:center"> <?php echo 'Parent Module'; ?>  </th>
            <th class="head1" style="text-align:center"> <?php echo 'Module'; ?> </th>
            <th class="head0" style="text-align:center"> <?php echo 'Status'; ?> </th>
			
	       
	        <th class="head1"><?php echo $this->Html->link( '<i class="fa fa-plus"></i> Add New Module', array( 'action' => 'add' ), array( 'class' => 'btn btn-primary', 'title' => 'Add', 'escape'=>false ) ); ?></th>
	        
	    </tr>
	</thead>
	<tbody>
	<?php foreach ($modules as $module): ?>
	<tr>
		<td>
			<?php 
				if($module['Module']['parent_id']!=0) { 
					echo ($lang == 1) ? $modulesArr[$module['Module']['parent_id']] : $modulesArrEn[$module['Module']['parent_id']];
				} else { 
					'None';
				} 
			?>
		</td>
        <td><?php echo h($module['Module'][($lang ==1) ? 'name' : 'name_en']); ?></td>
        <td><?php echo ($lang ==1) ? $status[$module['Module']['status']] : $status_en[$module['Module']['status']]; ?></td>
		<td class="actions">
			<?php //echo $this->Html->link(__('View'), array('action' => 'view', $module['Module']['id'])); ?>
            <?php //echo __( '|' ) ?>
			<?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $module['Module']['id'])); ?>
			<?php 
				if (!empty($module['Module']['status']) && $module['Module']['status']==1) {
					echo $this->Html->link( '<i class="wicon-pencil"></i>', array( 'action' => 'edit', $module['Module']['id'] ), array( 'class' => 'btn btn-xs btn-primary', 'title'=>($lang ==1) ? 'পরিবর্তন করুন ' : 'Edit',  'escape'=>false ) );
				} else {
					echo $this->Html->link( '<i class="wicon-pencil"></i>', array( 'action' => 'edit', $module['Module']['id'] ), array( 'class' => 'btn btn-xs btn-primary disabled', 'title'=>($lang ==1) ? 'পরিবর্তন করুন ' : 'Edit',  'escape'=>false ) );
				}
				if(!empty($module['Module']['status']) && $module['Module']['status']==1){
					echo $this->Html->link( '<i class="wicon-remove"></i>', array( 'action' => 'changeStatus', $module['Module']['id'],0 ), array( 'class' => 'btn btn-xs btn-primary margin-left-5', 'title'=>($lang ==1) ? 'নিষ্ক্রিয় ' : 'Inactive',  'escape'=>false ) ); 
				} else {
					echo $this->Html->link( '<i class="wicon-ok"></i>', array( 'action' => 'changeStatus', $module['Module']['id'],1 ), array( 'class' => 'btn btn-xs btn-primary margin-left-5', 'title'=>($lang ==1) ? 'সক্রিয় ' : 'Active',  'escape'=>false ) ); 
				}
				
			?>
            <?php //echo __( '|' ) ?>
			<?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $module['Module']['id']), array(), __('Are you sure you want to delete # %s?', $module['Module']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
<?php //echo $this->element('pagination') ;?>

</div> 

