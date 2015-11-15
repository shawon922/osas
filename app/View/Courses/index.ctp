<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>

    <div class="row pull-right">
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> Add New Course', array('controller' => 'courses', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Add',  'escape' => false ) ); 
        ?>
    </div>

    
    <table id="course-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>
          <th>Course Code</th>
          <th>Course Name</th>
          <th>Credit</th>
          <th width="20%">Action</th>
        </tr>
      </thead>
      <tbody>
          <?php 
              if (!empty($courses)) { 
                $i = 1;
                  foreach ($courses as $course) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $course['Course']['code']; ?></td>
              <td><?php echo $course['Course']['name']; ?></td>
              <td><?php echo $course['Course']['credit']; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i>', array('controller' => 'courses', 'action' => 'edit', $course['Course']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Form->postLink( '<i class="fa fa-times"></i>', array('controller' => 'courses', 'action' => 'changeStatus', $course['Course']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

                   ?>
              </td>
          </tr>

          <?php } } ?>
      </tbody>
    </table>

<?php //echo $this->element('pagination'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('#course-list').DataTable();
    });
</script>