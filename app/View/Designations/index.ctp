<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>

    <div class="row pull-right">
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> Add New Designation', array('controller' => 'designations', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Add',  'escape' => false ) ); 
        ?>
    </div>

    
    <table id="designation-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>
          <th>Designation</th>
          <th>Description</th>
          <th width="20%">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
              if (!empty($designations)) { 
                $i = 1;
                  foreach ($designations as $designation) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $designation['Designation']['name']; ?></td>
              <td><?php echo $designation['Designation']['description']; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i> Edit', array('controller' => 'designations', 'action' => 'edit', $designation['Designation']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Form->postLink( '<i class="fa fa-times"></i> Remove', array('controller' => 'designations', 'action' => 'changeStatus', $designation['Designation']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

                   ?>
              </td>
          </tr>

          <?php } } ?>
      </tbody>
    </table>

<?php //echo $this->element('pagination'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('#designation-list').DataTable();
    });
</script>