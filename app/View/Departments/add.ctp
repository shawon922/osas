    <?php 
        
        echo $this->Form->create('Department', array('class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="box-body">
       
            <?php 

                echo $this->Form->input('Department.name', array('type' => 'text', 'label' => array('text' => 'Department Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Department Name', 'class' => 'form-control', 'autocomplete' => 'off'));

                echo $this->Form->input('Department.short_name', array('type' => 'text', 'label' => array('text' => 'Short Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Department Short Name', 'class' => 'form-control', 'autocomplete' => 'off'));

                echo $this->Form->input('Department.code', array('type' => 'text', 'label' => array('text' => 'Department Code', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Department Code', 'class' => 'form-control', 'autocomplete' => 'off'));


                echo $this->Form->input('Department.description', array('type' => 'textarea', 'label' => array('text' => 'Description', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Department Description', 'class' => 'form-control', 'autocomplete' => 'off'));

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


    <?php
        echo $this->Form->end();
    ?>

