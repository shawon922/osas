<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));
?>



    
    <table id="user-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>
          <th>Name</th>
          <th>Email</th>
          <th>Contact No.</th>
          <th>Username</th>
          <th width="15%">
              <?php 
                  echo $this->Html->link( '<i class="fa fa-plus"></i>', array('controller' => 'users', 'action' => 'add'), array( 'class' => 'btn btn-primary', 'title' => 'Add',  'escape' => false ) ); 
              ?>
          </th>
        </tr>
      </thead>
      <tbody>
          <?php 
              if (!empty($users)) { 
                $i = 1;
                  foreach ($users as $user) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $user['User']['first_name'].' '.$user['User']['last_name']; ?></td>
              <td><?php echo $user['User']['email']; ?></td>
              <td><?php echo $user['User']['contact_no']; ?></td>
              <td><?php echo $user['User']['username']; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i>', array('controller' => 'users', 'action' => 'edit', $user['User']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Html->link( '<i class="fa fa-times"></i>', array('controller' => 'users', 'action' => 'changeStatus', $user['User']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ) );

                   ?>
              </td>
          </tr>

          <?php } } ?>
      </tbody>
    </table>

<?php //echo $this->element('pagination'); ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('#user-list').DataTable();
    });
</script>