<?php echo $this->Form->create('Department', array('class' => 'form-inline', 'novalidate' => true)); ?>

    <div class="row" style="">
        <div class="col-md-1"></div>
        <div class="col-md-2 text-right">
            <label>Department</label>
        </div>
        <div class="col-md-4">
            <?php 
                echo $this->Form->input('Department.department_id', array('type' => 'select', 'label' => false, 'empty' => '--Select Department--', 'class' => 'form-control', 'options' => $departments));
            ?>
        </div>        
        <div class="col-md-1">
            <?php 
                echo $this->Form->button('Submit', array('type' => 'submit', 'class' => 'btn btn-primary'));
            ?>
        </div>
    </div>

    <?php echo $this->Form->end(); ?>