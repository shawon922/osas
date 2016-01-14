    <?php 
        
        echo $this->Form->create('Course', array('class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="box-body">
       
            <?php                 

                echo $this->Form->input('Course.code', array('type' => 'text', 'label' => array('text' => 'Course Code', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Course Code', 'class' => 'form-control', 'autocomplete' => 'off'));

                echo $this->Form->input('Course.name', array('type' => 'text', 'label' => array('text' => 'Course Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Course Name', 'class' => 'form-control', 'autocomplete' => 'off'));


                echo $this->Form->input('Course.credit', array('type' => 'text', 'label' => array('text' => 'Course Credit', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Course Credit', 'class' => 'form-control', 'autocomplete' => 'off'));

                echo $this->Form->input('Course.department_id', array('type' => 'select', 'label' => array('text' => 'Department', 'class' => 'col-sm-2 control-label'), 'empty' => '--Select Department--', 'class' => 'form-control', 'options' => $departments));

        ?>

        <div class="box-footer col-md-3 col-md-offset-2" style="background-color: #ECF0F5;">

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

