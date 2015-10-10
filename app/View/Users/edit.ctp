    <?php 
        
        echo $this->Form->create('User', array('enctype' => 'multipart/form-data', 'class' => 'form-horizontal', 'novalidate' => true));

    ?>
    <div class="box-body">
        <?php
            echo $this->Form->input('User.first_name', array('type' => 'text', 'label' => array('text' => 'First Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'First Name', 'class' => 'form-control'));

            echo $this->Form->input('User.last_name', array('type' => 'text', 'label' => array('text' => 'Last Name', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Last Name', 'class' => 'form-control'));

            //echo $this->Form->input('User.designation_id', array('type' => 'select', 'label' => array('text' => 'Designation', 'class' => 'col-sm-2 control-label'), 'empty' => '--Select Designation--', 'class' => 'form-control', 'options' => array(1 => 'Dean', 2 => 'Head of Dept.', 3 => 'Professor', 4 => 'Assistant Professor', 5 => 'Lecturer')));

            echo $this->Form->input('User.username', array('type' => 'text', 'label' => array('text' => 'Username', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Username', 'class' => 'form-control'));

            echo $this->Form->input('User.password', array('type' => 'password', 'label' => array('text' => 'Password', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Password', 'class' => 'form-control'));

            echo $this->Form->input('User.confirm_password', array('type' => 'password', 'label' => array('text' => 'Confirm Password', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Confirm Password', 'class' => 'form-control'));

            echo $this->Form->input('User.email', array('type' => 'email', 'label' => array('text' => 'Email', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Email', 'class' => 'form-control'));

            echo $this->Form->input('User.contact_no', array('type' => 'text', 'label' => array('text' => 'Contact No.', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Contact No.', 'class' => 'form-control'));

            echo $this->Form->input('User.address', array('type' => 'textarea', 'label' => array('text' => 'Address', 'class' => 'col-sm-2 control-label'), 'placeholder' => 'Address', 'class' => 'form-control'));

            echo $this->Form->input('User.role_id', array('type' => 'select', 'label' => array('text' => 'Role', 'class' => 'col-sm-2 control-label'), 'empty' => '--Select Role--', 'class' => 'form-control', 'options' => array(1 => 'Admin', 2 => 'Teacher', 3 => 'Student', 4 => 'Other')));

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

