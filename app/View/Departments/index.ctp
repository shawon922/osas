<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>


    <div class="row pull-right">
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> Add New Department', array('controller' => 'departments', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Add Department',  'escape' => false ) ); 
        ?>
    </div>
    
    <table id="department-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>          
          <th>Short Name</th>
          <th>Name</th>
          <th>Code</th>
          <th>Description</th>
          <th width="20%">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
              if (!empty($departments)) { 
                $i = 1;
                  foreach ($departments as $department) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              
              <td><?php echo $department['Department']['short_name']; ?></td>
              <td><?php echo $department['Department']['name']; ?></td>
              <td><?php echo (!empty($department['Department']['code'])) ? $department['Department']['code'] : 'N/A'; ?></td>
              <td><?php echo (!empty($department['Department']['description'])) ? $department['Department']['description'] : 'N/A'; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i>', array('controller' => 'departments', 'action' => 'edit', $department['Department']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Form->postLink( '<i class="fa fa-times"></i>', array('controller' => 'departments', 'action' => 'changeStatus', $department['Department']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

                   ?>
              </td>
          </tr>

          <?php } } ?>
      </tbody>
    </table>

<?php //echo $this->element('pagination'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('#department-list').DataTable();
    });
</script>