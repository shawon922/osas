<style>
.show_privilege ul li { display:inline; }
</style>
<h4 class="widgettitle"> <?php echo ($lang == 1) ? 'আসাইন প্রিভিলেজ ' : 'Assign Privilege'; ?> </h4>
<?php 
	echo $this->Form->create('Privilege', array( 'url'=>'/roles/assignPrivilege/'.$role_id, /*'action'=>'assign_privilege',*/ 'role' => 'form', 'class' => 'stdform stdform2'  )); 
?>

<div class="table-responsive show_privilege widgetcontent bordered shadowed nopadding">
	<table class="table table-hover table-bordered" cellpadding="0" cellspacing="0">
	<colgroup>
    	<col class="con0" style="align: center; width: 25%" />
        <col class="con1" style="align: center; width: 75%" />
	</colgroup>
	<thead>
	<tr>
			<th> <?php echo ($lang == 1) ? ' মডিউল' : 'Module(s)'; ?> </th>
			<th> <?php echo ($lang == 1) ? ' মডিউল পারমিশন ' : 'Modules Permission'; ?>  </th>

	</tr>
	</thead>
	<tbody>
	<?php createModule($modules, $rolePrivileges, $role_id, $lang); ?>
	</tbody>
	</table>
	<p class="stdformbutton">
	<?php echo $this->Form->button(($lang == 1) ? 'হালনাগাদ করুন' : 'Update', array('type' => 'submit', 'class' => 'btn btn-primary')); ?>
	</p>
	<?php //echo $this->element('pagination') ;?>
</div>
<?php echo $this->Form->end(); ?>


<?php 
function getModulePkId($rolePrivileges, $module_id, $role_id)
{
	foreach(@$rolePrivileges as $pvRow){
		if($pvRow['Privilege']['module_id'] == $module_id && $pvRow['Privilege']['role_id'] == $role_id){
			return $pvRow['Privilege']['id'];
		}
	}
	return false;
}
function hasCheckedAll($rolePrivileges, $modules, $role_id, $ck_type, $module_id)
{
	//echo $role_id ." : " .$ck_type. " : " .$module_id;
	//echo '<br/>';
	
	$count1 = 0;
	$count2 = 0;
	$allChildModule = array();
	foreach (@$modules as $mRow) { 
		if ($mRow['Module']['parent_id'] == $module_id) {
			++$count1;
			$allChildModule[] = $mRow['Module']['id'];
		}
	}
	foreach(@$rolePrivileges as $pRow)
	{
		if($pRow['Privilege'][$ck_type] ==1 && $pRow['Privilege']['role_id'] == $role_id && in_array($pRow['Privilege']['module_id'], $allChildModule)) {
			++$count2;
		}
	}
	
	//$count2 = $count2 -1;
	//echo $count1 ." : ". $count2;
	//echo '<br/>';
	if ($count1 == $count2) {
		return "checked";
	}
	return false;
}
function hasChecked($rolePrivileges, $role_id, $ck_type, $module_id)
{
	foreach(@$rolePrivileges as $pvlRow){
		if($pvlRow['Privilege'][$ck_type] ==1 && $pvlRow['Privilege']['role_id'] == $role_id &&  $pvlRow['Privilege']['module_id'] == $module_id ){
			return "checked";
		}
	}
	return false;
}
function hasChild($moduless, $id) 
{
	foreach (@$moduless as $modulee){
		if ($modulee['Module']['parent_id'] == $id) {
			return true;
		}
	}
	return false;
}
function createModule($modules, $rolePrivileges, $role_id, $lang)
{
	static $k = 0;
	$modulesArrs = @$modules;
	$modulesArr2s = @$modules;
	foreach (@$modulesArrs as $moduleRow) {
	$module_id = $moduleRow['Module']['id'];
	$child = hasChild($modules, $moduleRow['Module']['id']);
?>
	<?php if($moduleRow['Module']['parent_id'] ==0) { ?>
	<tr>
		<td><?php echo ($lang == 1) ? ' মেনু নাম' : 'Menu Name'; ?> </td>
		<td>
			<?php 
				if ($moduleRow['Module']['parent_id'] == 0 && $child == true ) { 
		
				$checkCreateAll = hasCheckedAll($rolePrivileges, $modules, $role_id,'create', $moduleRow['Module']['id']);
				$checkReadAll = hasCheckedAll($rolePrivileges, $modules, $role_id,'read', $moduleRow['Module']['id']);
				$checkUpdateAll = hasCheckedAll($rolePrivileges, $modules, $role_id,'update', $moduleRow['Module']['id']);
				$checkDeleteAll = hasCheckedAll($rolePrivileges, $modules, $role_id,'delete', $moduleRow['Module']['id']);
				$checkStatusAll = hasCheckedAll($rolePrivileges, $modules, $role_id,'status', $moduleRow['Module']['id']);
				$m_pk_id = getModulePkId($rolePrivileges, $moduleRow['Module']['id'], $role_id);
				$m_pk_id = $m_pk_id > 0 ? $m_pk_id : 0;
				
			?>
				<input type="checkbox" class="checkModule" name="data[Privilege][<?php echo $moduleRow['Module']['id']; ?>][module_id]" value="<?php echo $module_id;?>" />
				<b> <?php echo ($lang ==1) ? $moduleRow['Module']['name'] : $moduleRow['Module']['name_en']; ?> </b>
				<div class="parentModule">
				<ul> 
					<li> 
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][id]" value="<?php echo $m_pk_id;?>" />
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][module_id]" value="<?php echo $moduleRow['Module']['id'];?>"/>
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][role_id]" value="<?php echo $role_id; ?>" />
						<input type="checkbox" class="checkCreate" name="data[Privilege][<?php echo $k; ?>][create]" value="1" <?php echo $checkCreateAll; ?> /> <?php echo ($lang ==1) ? 'তৈরি' : 'Create'; ?> 
					</li>
					<li> <input type="checkbox" class="checkRead" name="data[Privilege][<?php echo $k; ?>][read]" value="1" <?php echo $checkReadAll; ?> /> <?php echo ($lang ==1) ? 'পড়া' : 'Read'; ?>  </li>
					<li> <input type="checkbox" class="checkUpdate" name="data[Privilege][<?php echo $k; ?>][update]" value="1" <?php echo $checkUpdateAll; ?> /> <?php echo ($lang ==1) ? 'হালনাগাদ' : 'Update'; ?> </li>
					<li> <input type="checkbox" class="checkDelete" name="data[Privilege][<?php echo $k; ?>][delete]" value="1" <?php echo $checkDeleteAll; ?> /> <?php echo ($lang ==1) ? 'সংরক্ষণ ' : 'Archive'; ?>  </li>
					<li> <input type="checkbox" class="checkStatus" name="data[Privilege][<?php echo $k; ?>][status]" value="1" <?php echo $checkStatusAll; ?> /> <?php echo ($lang ==1) ? 'পর্যায়' : 'Status'; ?>  </li>
				<!-- </ul>-->
					<br/>
			<?php ++$k; } ?>
			<?php 
				$hasChild = 0;
				//$k = 1;
				/*if ($lang == 1) {  সংরক্ষণ 
					$create = 'তৈরী';
					$read = 'দেখা';
					$update = 'হালনাগাদ';
					$delete = 'মুছে ফেলা';
					$status = 'পর্যায়';
				} else {
					$create = 'create';
					$read = 'read';
					$update = 'update';
					$delete = 'delete';
					$status = 'status';
				}*/
				
				foreach ($modulesArr2s as $mRow2) { 
				if ($mRow2['Module']['parent_id'] == $moduleRow['Module']['id']) {
					$hasChild = 1;
					$checkCreate = hasChecked($rolePrivileges, $role_id,'create',$mRow2['Module']['id']);
					$checkRead = hasChecked($rolePrivileges, $role_id,'read',$mRow2['Module']['id']);
					$checkUpdate = hasChecked($rolePrivileges, $role_id,'update',$mRow2['Module']['id']);
					$checkDelete = hasChecked($rolePrivileges, $role_id,'delete',$mRow2['Module']['id']);
					$checkStatus = hasChecked($rolePrivileges, $role_id,'status',$mRow2['Module']['id']);
					
					$m_pk_id2 = getModulePkId($rolePrivileges, $mRow2['Module']['id'], $role_id);
					$m_pk_id2 = $m_pk_id2 > 0 ? $m_pk_id2 : 0;
					
			?>
				<!--<input type="checkbox" class="checkModule" value="<?php //echo $mRow2['Module']['id'];?>" />-->
				<li> 
				<b>	<?php  echo ($lang ==1) ? $mRow2['Module']['name'] : $mRow2['Module']['name_en']; ?> </b>
				<ul> 
					<li> 
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][id]" value="<?php echo $m_pk_id2;?>" />
						<input type="hidden" name="data[Privilege][<?php echo $k;?>][module_id]" value="<?php echo $mRow2['Module']['id'];?>" />
						<input type="hidden" name="data[Privilege][<?php echo $k;?>][role_id]" value="<?php echo $role_id;?>" />
						<input type="checkbox" class="checkCreate" name="data[Privilege][<?php echo $k;?>][create]" value="1" <?php echo $checkCreate; ?> /> <?php echo ($lang ==1) ? 'তৈরি' : 'Create'; ?> 
					</li>
					<li> <input type="checkbox" class="checkRead" name="data[Privilege][<?php echo $k;?>][read]" value="1" <?php echo $checkRead; ?> /> <?php echo ($lang ==1) ? 'পড়া' : 'Read'; ?> </li>
					<li> <input type="checkbox" class="checkUpdate" name="data[Privilege][<?php echo $k;?>][update]" value="1" <?php echo $checkUpdate; ?> /> <?php echo ($lang ==1) ? 'হালনাগাদ' : 'Update'; ?> </li>
					<li> <input type="checkbox" class="checkDelete" name="data[Privilege][<?php echo $k;?>][delete]" value="1" <?php echo $checkDelete; ?> /> <?php echo ($lang ==1) ? 'সংরক্ষণ ' : 'Archive'; ?> </li>
					<li> <input type="checkbox" class="checkStatus" name="data[Privilege][<?php echo $k;?>][status]" value="1" <?php echo $checkStatus; ?> /> <?php echo ($lang ==1) ? 'পর্যায়' : 'Status'; ?> </li>
				</ul>
				</li>
			<?php ++$k; } } ?>
				<!--<span class="lastSpan"></span>-->
				</ul>
				</div>
			<?php if ($hasChild == 0) { ?>
			<?php 
				$checkCreate = hasChecked($rolePrivileges, $role_id,'create',$moduleRow['Module']['id']);
				$checkRead = hasChecked($rolePrivileges, $role_id,'read',$moduleRow['Module']['id']);
				$checkUpdate = hasChecked($rolePrivileges, $role_id,'update',$moduleRow['Module']['id']);
				$checkDelete = hasChecked($rolePrivileges, $role_id,'delete',$moduleRow['Module']['id']);
				$checkStatus = hasChecked($rolePrivileges, $role_id,'status',$moduleRow['Module']['id']);
				
				$m_pk_id3 = getModulePkId($rolePrivileges, $moduleRow['Module']['id'], $role_id);
				$m_pk_id3 = $m_pk_id3 > 0 ? $m_pk_id3 : 0;
			?>
				<input type="checkbox" class="checkModule" value="<?php echo $module_id;?>" />
				<b> <?php echo ($lang ==1) ? $moduleRow['Module']['name'] :  $moduleRow['Module']['name_en']; ?> </b>
				<div class="parentModule">
				<ul> 
					<li> 
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][id]" value="<?php echo $m_pk_id3;?>" />
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][module_id]" value="<?php echo $module_id;?>" />
						<input type="hidden" name="data[Privilege][<?php echo $k; ?>][role_id]" value="<?php echo $role_id;?>" />
						<input type="checkbox" class="checkCreate" name="data[Privilege][<?php echo $k; ?>][create]" value="1" <?php echo $checkCreate; ?> /> <?php echo ($lang ==1) ? 'তৈরি' : 'Create'; ?> 
					</li>
					<li> <input type="checkbox" class="checkRead" name="data[Privilege][<?php echo $k; ?>][read]" value="1" <?php echo $checkRead; ?> /> <?php echo ($lang ==1) ? 'পড়া' : 'Read'; ?> </li>
					<li> <input type="checkbox" class="checkUpdate" name="data[Privilege][<?php echo $k; ?>][update]" value="1" <?php echo $checkUpdate; ?> /> <?php echo ($lang ==1) ? 'হালনাগাদ' : 'Update'; ?> </li>
					<li> <input type="checkbox" class="checkDelete" name="data[Privilege][<?php echo $k; ?>][delete]" value="1" <?php echo $checkDelete; ?> /> <?php echo ($lang ==1) ? 'সংরক্ষণ ' : 'Archive'; ?> </li>
					<li> <input type="checkbox" class="checkStatus" name="data[Privilege][<?php echo $k; ?>][status]" value="1" <?php echo $checkStatus; ?> /> <?php echo ($lang ==1) ? 'পর্যায়' : 'Status'; ?> </li>
				</ul>
				</div>
			<?php ++$k;} ?>
			<!-- </li>
		</ul> -->
		
		</td>
	</tr>
<?php } } ++$k;}?>

<script>
$(document).ready(function(){
	$(".parentModule" ).hide();
	$(".checkModule").on("change", function(e){
		e.stopPropagation();
		if($(this).is(':checked')){
			$(this).next().next(".parentModule").slideDown();
		} else {
			$(this).next().next('.parentModule').slideUp();
		}
	});

	$(document).on("change",".checkCreate",function () {
		$(this).closest('ul').find('.checkCreate').prop('checked', $(this).is(':checked'));
	});
	
	$(document).on("change",".checkRead",function () {
		$(this).closest('ul').find('.checkRead').prop('checked', $(this).is(':checked'));
	});
	
	$(document).on("change",".checkUpdate",function () {
		$(this).closest('ul').find('.checkUpdate').prop('checked', $(this).is(':checked'));
	});
	
	$(document).on("change",".checkDelete",function () {
		$(this).closest('ul').find('.checkDelete').prop('checked', $(this).is(':checked'));
	});
	
	$(document).on("change",".checkStatus",function () {
		$(this).closest('ul').find('.checkStatus').prop('checked', $(this).is(':checked'));
	});
});


/*
function getBaseUrl()
{
	var hostname = rtrn_url = '';
	hostname = location.hostname;
	if(hostname == 'localhost') {
		rtrn_url = location.origin + "/" + location.pathname.split('/')[1];
	} else {
		rtrn_url = location.origin;
	}
	return rtrn_url;
}

function getBaseUrl()
{
	var hostname = location.hostname;
	if(hostname == 'localhost') {
		return location.origin + "/" + location.pathname.split('/')[1];
	} 
	return location.origin;
}
*/
var baseUrl = getBaseUrl();
console.log(baseUrl);

//hostname = window.location.href; hostname = hostname.substring(0, (hostname.indexOf("index.php") == -1) ? hostname.length : hostname.indexOf("index.php"));
</script>
