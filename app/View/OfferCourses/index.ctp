<?php 
    echo $this->Html->css(array('../js/plugins/DataTables/media/css/jquery.dataTables')); 
    echo $this->Html->script(array('plugins/DataTables/media/js/jquery.dataTables.min'));

    $semesters = Configure::read('semester');
    $years = Configure::read('semester_year');
?>
    <?php echo $this->Form->create('OfferCourse', array('class' => 'form-inline', 'novalidate' => true)); ?>

    <div class="row" style="margin-bottom: 50px;">
        <div class="col-md-1 text-right">
            <label>Department</label>
        </div>
        <div class="col-md-4">
            <?php 
                echo $this->Form->input('OfferCourse.department_id', array('type' => 'select', 'label' => false, 'empty' => '--Select Department--', 'class' => 'form-control', 'options' => $departments));
            ?>
        </div>
        <div class="col-md-1 text-right">
            <label>Semester</label>
        </div>
        <div class="col-md-2">
            <?php 
                echo $this->Form->input('OfferCourse.semester', array('type' => 'select', 'label' => false, 'empty' => '--Select Semester--', 'class' => 'form-control', 'options' => $semesters));
            ?>
        </div>
        <div class="col-md-1 text-right">
            <label>Year</label>
        </div>
        <div class="col-md-2">
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
            echo $this->Html->link( '<i class="fa fa-plus"></i> Offer Course', array('controller' => 'offer_courses', 'action' => 'add'), array( 'class' => 'btn btn-primary add-button', 'title' => 'Click here to offer new course',  'escape' => false/*, 'data-toggle' => 'modal', 'data-target' =>'#myModal'*/, 'data-toggle' => 'tooltip',  'data-placement' => 'top') ); 
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
              if (!empty($offered_courses)) { 
                $i = 1;
                  foreach ($offered_courses as $course) {
           ?>
          <tr>
              <td><?php echo $i++; ?></td>
              <td><?php echo $course['Course']['code']; ?></td>
              <td><?php echo $course['Course']['name']; ?></td>
              <td><?php echo $course['User']['first_name'].' '.$course['User']['last_name']; ?></td>
              <td>
                  <?php 
                      echo $this->Html->link( '<i class="fa fa-pencil"></i>', array('controller' => 'offer_courses', 'action' => 'edit', $course['OfferCourse']['id']), array( 'class' => 'btn btn-primary', 'title' => 'Edit',  'escape' => false ) ); 

                      echo ' ';

                      echo $this->Form->postLink( '<i class="fa fa-times"></i>', array('controller' => 'offer_courses', 'action' => 'changeStatus', $course['OfferCourse']['id'], '0'), array( 'class' => 'btn btn-primary', 'title' => 'Remove',  'escape' => false ), __('Are you sure ?'));

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


<!-- Using modeal for add.ctp view -->


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $title_for_layout; ?></h4>
      </div>
      <div class="modal-body">
          <?php 
              echo $this->Html->css(array('../js/plugins/select2/select2.min')); 
              echo $this->Html->script(array('plugins/select2/select2.full.min'));

              $batch = Configure::read('batch');
              $semesters = Configure::read('semester');
              $years = Configure::read('semester_year');
              
              echo $this->Form->create('OfferCourse', array('class' => 'form-horizontal', 'novalidate' => true));

          ?>
          <div class="box-body">

              <div class="row" style="margin-bottom: 50px;">
              <div class="col-md-1"></div>
              <div class="col-md-1 text-right">
                  <label>Semester</label>
              </div>
              <div class="col-md-3">
                  <?php 
                      echo $this->Form->input('OfferCourse.semester', array('type' => 'select', 'label' => false, 'empty' => '--Select Semester--', 'class' => 'form-control', 'options' => $semesters, 'style' => 'min-width: 230px;'));
                  ?>
              </div>
              <div class="col-md-1 text-right">
                  <label>Year</label>
              </div>
              <div class="col-md-3">
                  <?php 
                      echo $this->Form->input('OfferCourse.year', array('type' => 'select', 'label' => false, 'empty' => '--Select Year--', 'class' => 'form-control', 'options' => $years, 'value' => 1, 'style' => 'min-width: 230px;'));
                  ?>
              </div>
             
              <table id="offer-course-table" class="table table-bordered table-responsive">
                  <thead>
                      <th class="text-center" width="30%">Course</th>
                      <th class="text-center" width="30%">Teacher</th>
                      <th class="text-center" width="30%">Batch</th>
                      <th class="pull-right">
                          <?php 
                              echo $this->Form->button('<i class="fa fa-plus"></i> Add More', array('type' => 'button', 'class' => 'btn btn-primary offer-more-course'));
                          ?>
                      </th>
                  </thead>
                  <tbody>
                      <tr>
                          <td>
                              <?php echo $this->Form->input('OfferCourse.0.course_id', array('type' => 'select', 'empty' => '--Select Course--', 'class' => 'select2', 'label' => false, 'options' => $courses)); ?>
                          </td>
                          <td>
                              <?php echo $this->Form->input('OfferCourse.0.user_id', array('type' => 'select', 'empty' => '--Select Teacher--', 'class' => 'select2', 'label' => false, 'options' => $teachers)); ?>
                          </td>
                          <td>
                              <?php echo $this->Form->input('OfferCourseChild.0.batch', array('type' => 'select', 'label' => false, 'class' => 'select2', 'multiple' => true, 'data-placeholder' => '--Select Batch--', 'options' => $batch, 'style' => 'min-width: 230px;')); ?>
                          </td>
                      </tr>
                  </tbody>
              </table>
                  

              <div class="box-footer col-md-3" style="background-color: #ECF0F5;">

              <?php

                  echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-primary'));

                  echo ' ';

                  echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-warning'));

                  echo ' ';

                  echo $this->Form->button('Cancel', array('type' => 'button', 'class' => 'btn btn-danger'));
              ?>
              </div>
          </div>


          <?php
              echo $this->Form->end();
          ?>


          <script type="text/javascript">
              $(document).ready(function() {
                  $(".select2").select2();
              });

              $(document).ready(function() { 
                  var i = 1;
                  $(document).on("click", ".offer-more-course", function() {
                      
                      url = "<?php echo $this->webroot.'offer_courses/addOfferCourseTr/'; ?>"+i;

                      $.ajax({
                          url: url,
                          type: "POST",
                          cache: false
                      }).done(function(newTr) {
                          $("#offer-course-table > tbody:last-child").append(newTr);
                          $(".select2").select2();
                      });
                      
                      
                      ++i;
                  });

                  $(document).on("click", ".delete-row", function() {
                      $(this).closest("tr").remove();
                  });
              });
          </script>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>