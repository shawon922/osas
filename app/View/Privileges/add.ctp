<h3><?php echo __('Add Privilege'); ?></h3>
<style>
#show_privilege li { display:inline; }
</style>
<div class="ministries form well">
<?php echo $this->Form->create('Privilege', array( 'role' => 'form', 'inputDefaults' => array( 'div' => 'form-group' ) )); ?>
	<?php
		echo $this->Form->input( 'role_id', array( 'autocomplete' => 'off', 'class' => 'form-control','empty'=>'Select One' ,'options'=>$roles ) );
		echo $this->Form->input( 'module_id', array( 'id'=>'module_id', 'autocomplete' => 'off', 'class' => 'form-control','empty'=>'Select One' ,'options'=>$modules, 'multiple' => true ) );
		//echo $this->Form->input( 'sub_module_id', array( 'autocomplete' => 'off', 'class' => 'form-control','empty'=>'Select One' ,'options'=>$subModules ) );
		//echo $this->Form->input('entered_by', array( 'autocomplete' => 'off', 'class' => 'form-control' ) );
		echo '<div id="show_privilege_div" class="form-group show_privilege_div"><span id="show_privilege"> </span></div>';
		echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-primary'));
	?>
<?php echo $this->Form->end(); ?>
</div>
<script>
function getRoleManagementData(module_id, callback) 
{
	$.ajax({
		method : "POST",
		url : "/pmis_demo/privileges/getRoleManagementData",
		data : { module_id : module_id },
		dataType : 'json',
		cache : false,
		beforeSend : function () {
		
		}
	}).done(function(response){
		callback(response);
	});
}

$(document).ready(function(){
	$("#module_id").on("change", function(){
		console.log($("#module_id").val());
		getRoleManagementData($("#module_id").val(), function(response){
			var appHtml = '';
			var i = 0;
			console.log(response.length);
			
			if(response.length > 1) {
				appHtml += '<ul>';
				appHtml += '<li> <b> '+ $("#module_id option:selected").text() +' </b> &nbsp; &nbsp; </li>';
				
				appHtml += '<li> <input type="checkbox" class="checkCreateAll" value="1" /> Create </li>';
				appHtml += '<li> <input type="checkbox" class="checkReadAll" value="1" /> Read </li>';
				appHtml += '<li> <input type="checkbox" class="checkUpdateAll" value="1" /> Update </li>';
				appHtml += '<li> <input type="checkbox" class="checkDeleteAll" value="1" /> Delete </li>';
				appHtml += '<li> <input type="checkbox" class="checkStatusAll" value="1" /> Status </li>';
				appHtml += "</ul>";
			}
			$.each(response, function (key, value){
				++i; 
				//console.log(response[key].id);
				//console.log(response[key].parent_id);
				//console.log(response[key].name);
				appHtml += '<ul>';
				appHtml += '<li> <b> '+ response[key].name +' </b> &nbsp; &nbsp; </li>';
				appHtml += '<li> <input type="hidden" name=["Privilege"]["module_id"'+ i + '] id="module_id"'+ i +'] value="'+ response[key].id +'" /> </li>';
				//appHtml += '<li> <input type="checkbox" name=["Privilege"]["module_id"'+ i + '] id="module_id"'+ i +'] value="'+ response[key].id +'" /> </li>';
				appHtml += '<li> <input type="checkbox" class="checkCreate" name=["Privilege"]["create"'+ i + '] id="create"'+ i +'] value="1" /> Create </li>';
				appHtml += '<li> <input type="checkbox" class="checkRead" name=["Privilege"]["read"'+ i + '] id="read"'+ i +'] value="1" /> Read </li>';
				appHtml += '<li> <input type="checkbox" class="checkUpdate" name=["Privilege"]["update"'+ i + '] id="update"'+ i +'] value="1" /> Update </li>';
				appHtml += '<li> <input type="checkbox" class="checkDelete" name=["Privilege"]["delete"'+ i + '] id="delete"'+ i +'] value="1" /> Delete </li>';
				appHtml += '<li> <input type="checkbox" class="checkStatus" name=["Privilege"]["status"'+ i + '] id="status"'+ i +'] value="1" /> Status </li>';
				appHtml += "</ul>";
			});
				
				//$("#show_privilege_div").show();
				//$( "#show_privilege" ).append( appHtml );
				$( "#show_privilege" ).html( appHtml );
			console.log(response);
		});
	});
	
	$(document).on("change",".checkCreateAll", function(){
		if($(this).is(':checked')){
			$(".checkCreate").prop("checked",true);
		} else {
			$(".checkCreate").prop("checked",false);
		}
	});
	
	$(document).on("change",".checkReadAll", function(){
		if($(this).is(':checked')){
			$(".checkRead").prop("checked",true);
		} else {
			$(".checkRead").prop("checked",false);
		}
	});
	
	$(document).on("change",".checkUpdateAll", function(){
		if($(this).is(':checked')){
			$(".checkUpdate").prop("checked",true);
		} else {
			$(".checkUpdate").prop("checked",false);
		}
	});
	
	$(document).on("change",".checkDeleteAll", function(){
		if($(this).is(':checked')){
			$(".checkDelete").prop("checked",true);
		} else {
			$(".checkDelete").prop("checked",false);
		}
	});
	
	$(document).on("change",".checkStatusAll", function(){
		if($(this).is(':checked')){
			$(".checkStatus").prop("checked",true);
		} else {
			$(".checkStatus").prop("checked",false);
		}
	});
	
});
</script>

