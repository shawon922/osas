<section class="content-header">
    <h1>
        Dashboard
        <small><?php echo $title_for_layout; ?></small>
    </h1>
</section>

<section class="content">
    <?php 
        echo $this->Form->create('User', array('enctype' => 'multipart/form-data'));
                
        echo $this->Form->input('name', array('required' => true, 'placeholder'=>'Name', 'label'=> array('text'=>'Name'), 'autocomplete'=>'off')); 
        

        echo '<p class="stdformbutton">';
        echo $this->Form->button('Save', array('type' => 'submit', 'class' => 'btn btn-primary'));
        echo $this->Form->button('Reset', array('type' => 'reset', 'class' => 'btn btn-primary margin-left-5'));
        echo $this->Form->button('Cancel', array('type' => 'button', 'class' => 'btn btn-primary margin-left-5','onclick'=>'cancel(\'users\')'));
        echo '</p>';
        echo $this->Form->end(); 
    ?>
</section>