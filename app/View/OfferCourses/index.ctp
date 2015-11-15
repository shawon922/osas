<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));

    $semesters = Configure::read('semester');
    $years = Configure::read('semester_year');
?>
    <?php echo $this->Form->create('OfferCourse', array('class' => 'form-inline', 'novalidate' => true)); ?>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-md-1"></div>
        <div class="col-md-1 text-right">
            <label>Semester</label>
        </div>
        <div class="col-md-3">
            <?php 
                echo $this->Form->input('OfferCourse.semester_id', array('type' => 'select', 'label' => false, 'empty' => '--Select Semester--', 'class' => 'form-control', 'options' => $semesters));
            ?>
        </div>
        <div class="col-md-1 text-right">
            <label>Year</label>
        </div>
        <div class="col-md-3">
            <?php 
                echo $this->Form->input('OfferCourse.year', array('type' => 'select', 'label' => false, 'empty' => '--Select Year--', 'class' => 'form-control', 'options' => $years, 'value' => 1));
            ?>
        </div>
        <div class="col-md-1">
            <?php 
                echo $this->Form->button('Search', array('type' => 'submit', 'class' => 'btn btn-primary'));
            ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>

    <div class="row pull-right">
        <?php 
            echo $this->Html->link( '<i class="fa fa-plus"></i> Offer Course', array('controller' => 'offer_courses', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Offer Course',  'escape' => false ) ); 
              ?>
    </div>

    <table id="course-list" cellpadding="4" cellspacing="4" class="table table-hover table-bordered">
      <thead>

        <tr>
          <th>SL.</th>
          <th>Course Code</th>
          <th>Course Name</th>
          <th>Teacher Name</th>
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
              <td><?php echo $course['Teacher']['first_name'].' '.$course['Teacher']['first_name']; ?></td>
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