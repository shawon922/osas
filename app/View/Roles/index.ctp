<?php 
	$status_en = Configure::read("status_en");
	$status_bn = Configure::read("status");
?>
<h4 class="widgettitle"><?php echo $title_for_layout ?> </h4>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">
            <?php //echo $title_for_layout ?> <?php //echo $this->Html->link( '<span class="glyphicon glyphicon-plus"></span> Add New', array( 'action' => 'add' ), array( 'class' => 'btn btn-xs btn-default', 'escape' => false, 'title' => 'Add New' ) ) ?>
        </h3>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-bordered" id="roles">
        <thead>
	        <tr>
                <th> <?php echo ($lang ==1) ? ' রোল ' : 'Role' ?> </th>
                <th colspan="5"> <?php echo ($lang ==1) ? ' প্রিভিলেজ ' : 'Privilege' ?> </th>
		        <th><?php echo ($lang ==1) ? ' পর্যায় ' : 'Status' ?></th>
                <th title="Create Role"> <?php echo $this->Html->link( '<i class="iconfa-plus"></i>', array( 'controller' => 'Roles', 'action' => 'add' ), array( 'class' => 'btn btn-xs btn-primary', 'title'=> ($lang ==1) ? 'ব্যবহারকারী রোল তৈরি করুন' : 'Create Role', 'escape' => false )); ?> </th>
	        </tr>
			<tr>
                <th></th>
                <th><?php echo ($lang ==1) ? ' যোগ করুন  ' : 'Create' ?></th>
                <th><?php echo ($lang ==1) ? ' দেখুন   ' : 'Read' ?></th>
                <th><?php echo ($lang ==1) ? ' আপডেট ' : 'Update' ?></th>
                <th><?php echo ($lang ==1) ? ' ডিলিট ' : 'Delete' ?></th>
		        <th><?php echo ($lang ==1) ? ' পর্যায় ' : 'Status' ?></th>
		        <th></th>
		        <th></th>
	        </tr>
        </thead>
        <tbody>
        <?php foreach ($roles as $data): $id = $data['Role']['id']; //pr($data['Privilege']); //extract( $data['Role'] );   ?>
	        <tr> 
                <td> <?php echo ($lang ==1) ? $data['Role']['name'] : $data['Role']['name_en']; ?> </td>
                <td> 
					<?php 
						$create = '';
						$createEn = '';
						foreach(@$data['Privilege'] as $createRow){
							if(@$createRow['create']==1){
								$create .= ', '. $createRow['Module']['name'];
								$createEn .= ', '. $createRow['Module']['name_en'];
							}
						}
						echo ($lang ==1) ? ltrim($create,',') : ltrim($createEn,','); 
					?> 
				</td>
				<td> 
					<?php 
						$read = '';
						$readEn = '';
						foreach(@$data['Privilege'] as $readRow){
							if(@$readRow['read']==1){
								$read .= ', '. @$readRow['Module']['name'];
								$readEn .= ', '. @$readRow['Module']['name_en'];
							}
						}
						echo ($lang ==1) ? ltrim($read,',') : ltrim($readEn,','); 
					?> 
				</td>
                <td> 
					<?php 
						$update = '';
						$updateEn = '';
						foreach(@$data['Privilege'] as $updateRow){
							if(@$updateRow['update']==1){
								$update .= ', '. @$updateRow['Module']['name'];
								$updateEn .= ', '. @$updateRow['Module']['name_en'];
							}
						}
						echo ($lang ==1) ? ltrim($update,',') : ltrim($updateEn,','); 
					?> 
				</td>
                <td> 
					<?php 
						$delete = '';
						$deleteEn = '';
						foreach(@$data['Privilege'] as $deleteRow){
							if(@$deleteRow['delete']==1){
								$delete .= ', '. @$deleteRow['Module']['name'];
								$deleteEn .= ', '. @$deleteRow['Module']['name_en'];
								//$deleteEn .= ', '.($lang ==1) ? @$deleteRow['Module']['name'] : @$deleteRow['Module']['name_en'];
							}
						}
						echo ($lang ==1) ? ltrim($delete,',') :  ltrim($deleteEn,','); 
					?> 
				</td>
				
				<td> 
					<?php 
						$status = '';
						$statusEn = '';
						foreach(@$data['Privilege'] as $statusRow){
							if(@$statusRow['status']==1){
								$status .= ', '. @$statusRow['Module']['name'];
								$statusEn .= ', '. @$statusRow['Module']['name_en'];
							}
						}
						echo ($lang ==1) ? ltrim($status,',') : ltrim($statusEn,','); 
					?> 
				</td>

                <td> <?php echo ($lang==1) ? $status_bn[$data['Role']['status']] : $status_en[$data['Role']['status']];  ?> </td>
		        
		        <td>
					<?php $m_status = $data['Role']['status']==0 ? "Active":"Inactive"; //echo "{$m_status}"; ?>
			        <?php 
				        if (!empty($data['Role']['status']) && $data['Role']['status']==1) {
				        	echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $id), array('class'=>'btn btn-primary', 'escape' => false, 'title' => ($lang ==1) ? 'পরিবর্তন করুন' : 'Edit')); 
							echo '<br/>';
							echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array( 'action' => 'assignPrivilege', $id), array('class'=>'btn btn-primary', 'escape' => false, 'title' => ($lang ==1) ? 'অ্যাসাইন  প্রিভিলেজ' : 'Assign Privilege')); 
				        } else {
				        	echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $id), array('class'=>'btn btn-primary disabled', 'escape' => false, 'title' => ($lang ==1) ? 'পরিবর্তন করুন' : 'Edit'));
							echo '<br/>';
							echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array( 'action' => 'assignPrivilege',0), array('class'=>'btn btn-primary disabled', 'escape' => false, 'title' => ($lang ==1) ? 'অ্যাসাইন  প্রিভিলেজ' : 'Assign Privilege')); 
				        }
			        	?> 
                    <?php //echo '<br/>';//echo __('|'); ?> 
					<?php //echo $this->Html->link('<span class="glyphicon glyphicon-plus"></span>', array( 'action' => 'assignPrivilege', $id), array('class'=>'btn btn-primary', 'escape' => false, 'title' => ($lang ==1) ? 'অ্যাসাইন  প্রিভিলেজ' : 'Assign Privilege')); ?> 
					<?php echo '<br/>';//echo __('|'); ?> 
					<?php  //echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>'.$m_status, array('controllers'=>'privileges', 'action' => 'status_change', $id), array('escape' => false, 'title' => 'Status Change','class'=>'status_change')); ?> 
			        <?php 
					if(!empty($data['Role']['status']) && $data['Role']['status']==1){
						echo $this->Html->link( '<i class="glyphicon glyphicon-remove"></i>', array( 'action' => 'changeStatus', $data['Role']['id'],0 ), array( 'class' => 'btn btn-xs btn-primary', 'title'=>($lang ==1) ? 'নিষ্ক্রিয় ' : 'Inactive',  'escape'=>false ) ); 
					} else {
						echo $this->Html->link( '<i class="glyphicon glyphicon-ok"></i>', array( 'action' => 'changeStatus', $data['Role']['id'],1 ), array( 'class' => 'btn btn-xs btn-primary', 'title'=>($lang ==1) ? 'সক্রিয় ' : 'Active',  'escape'=>false ) ); 
					}
					//echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span>'.$m_status, array('action' => 'changeStatus', $id, $data['Role']['status']==1? 0 : 1 ), array('class'=>'btn btn-primary status_change', 'escape' => false, 'title' => ($lang ==1) ? 'ডিলিট' :'Delete'), 'Are you sure?'); 
					
					?>
					
			        <?php //echo $this->Html->link('<span class="glyphicon glyphicon-remove"></span> Delete', array('action' => 'delete', $id), array('escape' => false, 'title' => 'Delete'), 'Are you sure?'); ?>
		        </td>
	        </tr>
        <?php endforeach; ?>
        </tbody>
        </table>
    </div>
</div>
<script>
/* $(document).ready(function(){
	$(".status_change").on("click",function(){
		
	});
}); */

</script>