    <?php 
        echo $this->Html->css(array('../js/plugins/select2/select2.min')); 
        echo $this->Html->script(array('plugins/select2/select2.full.min'));

        $batch = Configure::read('batch');
        $semesters = Configure::read('semester');
        $years = Configure::read('semester_year');
        
        echo $this->Form->create('OfferCourse', array('class' => 'form-horizontal', 'novalidate' => true));

    ?>

    <style type="text/css">
        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: #3c8dbc;        
            color: #fff;
        }
    </style>

    
    <div class="box-body">

        <div class="row" style="margin-bottom: 50px;">
        <div class="col-md-1 text-right">
            <label>Department</label>
        </div>
        <div class="col-md-3">
            <?php 
                echo $this->Form->input('OfferCourse.department_id', array('type' => 'select', 'label' => false, 'empty' => '--Select Department--', 'class' => 'form-control', 'options' => $departments, 'span' => false, 'style' => 'min-width: 230px;'));
            ?>
        </div>
        <div class="col-md-1 text-right">
            <label>Semester</label>
        </div>
        <div class="col-md-3">
            <?php 
                echo $this->Form->input('OfferCourse.semester', array('type' => 'select', 'label' => false, 'empty' => '--Select Semester--', 'class' => 'form-control', 'options' => $semesters, 'style' => 'min-width: 170px;'));
            ?>
        </div>
        <div class="col-md-1 text-right">
            <label>Year</label>
        </div>
        <div class="col-md-2">
            <?php 
                echo $this->Form->input('OfferCourse.year', array('type' => 'select', 'label' => false, 'empty' => '--Select Year--', 'class' => 'form-control', 'options' => $years, 'value' => 1, 'style' => 'min-width: 170px;'));
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
                        <?php echo $this->Form->input('OfferCourse.course_id', array('type' => 'select', 'empty' => '--Select Course--', 'class' => 'select2', 'label' => false, 'options' => $courses)); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('OfferCourse.user_id', array('type' => 'select', 'empty' => '--Select Teacher--', 'class' => 'select2', 'label' => false, 'options' => $teachers)); ?>
                    </td>
                    <td>
                        <?php echo $this->Form->input('OfferCourseChild.batch', array('type' => 'select', 'label' => false, 'class' => 'select2', 'multiple' => true, 'data-placeholder' => '--Select Batch--', 'options' => $batch, 'style' => 'min-width: 230px;')); ?>
                    </td>
                </tr>
            </tbody>
        </table>
            

        <div class="box-footer col-md-3" style="background-color: #ECF0F5;">

        <?php

            echo $this->Form->button('Update', array('type' => 'submit', 'class' => 'btn btn-primary'));

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
    </script>

