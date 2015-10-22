<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>



    
    <table id="employee-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>
          <th>Name</th>
          <th>Designation</th>
          <th>Department</th>
          <th width="15%">
              <?php 
                  echo $this->Html->link( '<i class="fa fa-plus"></i> Add Employee', array('controller' => 'employees', 'action' => 'add'), array( 'class' => 'btn btn-primary', 'title' => 'Add',  'escape' => false ) ); 
              ?>
          </th>
        </tr>
      </thead>
      <tbody>
          <?php 
              if (!empty($employees)) { 
                $i = 1;
                  foreach ($employees as $employee) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $employee['Employee']['first_name'].' '.$employee['Employee']['last_name']; ?></td>
              <td><?php echo $employee['Designation']['name']; ?></td>
              <td><?php echo $employee['Department']['name']; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i>', array('controller' => 'employees', 'action' => 'edit', $employee['Employee']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Form->postLink( '<i class="fa fa-times"></i>', array('controller' => 'employees', 'action' => 'changeStatus', $employee['Employee']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

                   ?>
              </td>
          </tr>

          <?php } } ?>
      </tbody>
    </table>

<?php //echo $this->element('pagination'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('#employee-list').DataTable();
    });
</script>