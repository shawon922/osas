<?php 
    $batch = Configure::read('batch');
 ?>

<tr>
    <td>
        <?php echo $this->Form->input('OfferCourse.'.$i.'.course_id', array('type' => 'select', 'empty' => '--Select Course--', 'class' => 'select2', 'label' => false, 'options' => $courses)); ?>
    </td>
    <td>
        <?php echo $this->Form->input('OfferCourse.'.$i.'.user_id', array('type' => 'select', 'empty' => '--Select Teacher--', 'class' => 'select2', 'label' => false, 'options' => $teachers)); ?>
    </td>
    <td>
        <?php echo $this->Form->input('OfferCourse.'.$i.'.batch', array('type' => 'select', 'label' => false, 'class' => 'select2', 'multiple' => true, 'data-placeholder' => '--Select Batch--', 'options' => $batch, 'style' => 'min-width: 230px;')); ?>
    </td>
    <td>
        <?php echo $this->Form->button('Delete', array('type' => 'button', 'title' => 'Delete', 'class' => 'btn btn-danger delete-row')); ?>
    </td>
</tr>

