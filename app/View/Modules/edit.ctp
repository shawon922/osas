    <?php 
        
        echo $this->Form->create('Module', array('class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="box-body">
       
            <?php 

                echo $this->Form->input('Module.parent_id', array('empty'=> '--Select One--' , 'type' => 'select', 'label' => array('text' => 'Parent Module', 'class' => 'col-sm-2 control-label'), 'class' => 'form-control', 'autocomplete' => 'off', 'options' => $modules));

                echo $this->Form->input('Module.name', array('type' => 'text', 'label' => array('text' => 'Module Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Module Name', 'class' => 'form-control', 'autocomplete' => 'off'));

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

