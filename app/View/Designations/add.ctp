    <?php 
        
        echo $this->Form->create('Designation', array('class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="box-body">
       
            <?php 


                echo $this->Form->input('Designation.name', array('type' => 'text', 'label' => array('text' => 'Designation Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Designation Name', 'class' => 'form-control', 'autocomplete' => 'off'));


                echo $this->Form->input('Designation.description', array('type' => 'textarea', 'label' => array('text' => 'Description', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Designation Description', 'class' => 'form-control', 'autocomplete' => 'off'));

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

