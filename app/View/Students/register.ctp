<?php 
    
    echo $this->Html->css(array('../js/plugins/datepicker/datepicker3', '../js/plugins/daterangepicker/daterangepicker-bs3', 'style'));
    
    
?>

<style type="text/css">
    .radio,
    .checkbox {
      min-height: 20px;
      padding-left: 20px;
    }
    .radio.inline,
    .checkbox.inline {
      display: inline-block;
      padding-top: 5px;
      margin-bottom: 0;
      vertical-align: middle;
    }
     
    .radio.inline + .radio.inline,
    .checkbox.inline + .checkbox.inline {
      margin-left: 10px;
    }

    .radio-group {
        margin-left: 15px;
    }
</style>

    <?php 
        $gender = Configure::read('gender');
        
        echo $this->Form->create('Student', array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="row">
        <div class="box-body">
           
                <?php 

                    echo $this->Form->input('Student.first_name', array('type' => 'text', 'label' => array('text' => 'First Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'First Name', 'class' => 'form-control', 'autocomplete' => 'off'));

                    echo $this->Form->input('Student.last_name', array('type' => 'text', 'label' => array('text' => 'Last Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Last Name', 'class' => 'form-control', 'autocomplete' => 'off'));

                    echo $this->Form->input('Student.date_of_birth', array('type' => 'text', 'label' => array('text' => 'Date of Birth', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'dd-mm-yyyy', 'class' => 'form-control datepicker', 'readonly' => true, 'date-data-format' => 'dd-mm-yyyy', 'data-provide'=> 'datepicker-inline'));

                    
                    
                    echo '<div class="form-group"><label class="col-sm-2 control-label" for="StudentGender">Gender</label><span class="radio-group">';
                    echo $this->Form->input("Student.gender",
                        array(
                        'div' => "radio inline",
                        'separator' => '</div><div class="radio inline">',
                        'label' => false,
                        'type' => 'radio',
                        'default'=>0,
                        'legend' => false,
                        'options' => $gender
                        )
                    );

                    echo '</span></div>';

                    echo $this->Form->input('Student.date_of_joining', array('type' => 'text', 'label' => array('text' => 'Date of Joining', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'dd-mm-yyyy', 'class' => 'form-control datepicker', 'readonly' => true, 'date-data-format' => 'dd-mm-yyyy', 'data-provide'=> 'datepicker-inline'));

                    
                    echo $this->Form->input('Student.designation_id', array('type' => 'select', 'label' => array('text' => 'Designation', 'class' => 'col-sm-2 control-label'), 'empty' => '--Select Designation--', 'class' => 'form-control', 'options' => array(1 => 'Dean', 2 => 'Head of Dept.', 3 => 'Professor', 4 => 'Assistant Professor', 5 => 'Lecturer')));

                    echo $this->Form->input('Student.department_id', array('type' => 'select', 'label' => array('text' => 'Department', 'class' => 'col-sm-2 control-label'), 'empty' => '--Select Department--', 'class' => 'form-control', 'options' => array(1 => 'CSE', 2 => 'BBA', 3 => 'IS', 4 => 'GP', 5 => 'Econ')));

                    echo $this->Form->input('Student.email', array('type' => 'email', 'label' => array('text' => 'Email', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Email', 'class' => 'form-control'));

                    echo $this->Form->input('Student.contact_no', array('type' => 'text', 'label' => array('text' => 'Contact No.', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Contact No.', 'class' => 'form-control', 'autocomplete' => 'off'));

                    echo $this->Form->input('Student.address', array('type' => 'textarea', 'label' => array('text' => 'Address', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Address', 'class' => 'form-control', 'autocomplete' => 'off'));
                    

            ?>

            <div class="box-footer">

            <?php

                echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-primary'));

                echo ' ';

                echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-warning'));

                echo ' ';

                echo $this->Form->button('Cancel', array('type' => 'button', 'class' => 'btn btn-danger'));
            ?>
            </div>
        </div>
    </div>


    <?php
        echo $this->Form->end();
    ?>


    <?php 
        echo $this->Html->script(array('plugins/datepicker/bootstrap-datepicker'));
    ?>


<script type="text/javascript">
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true,
            todayHighlight: true
        });
    });
</script>
