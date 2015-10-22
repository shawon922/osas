<?php
//create this file called 'MyFormHelper.php' in your View/Helper folder
App::uses('FormHelper', 'View/Helper');
class MyFormHelper extends FormHelper {

    public function create($model = null, $options = array()) {
        //$mainLabelOptions = array('class' => 'col-sm-2 control-label');
        $defaultOptions = array(
            'inputDefaults' => array(
                'div' => array('class' => 'form-group'),
                'format'  => array( 'before', 'label', 'between', 'input', 'error', 'after' ),
                /*'class' => 'form-control',*/
                /*'label' => $mainLabelOptions,*/
                'between' => '<span class="col-sm-6">',
                'error'   => array( 'attributes' => array( 'wrap'  => 'span','class' => 'text-danger margin-left-5 number' ) )
            )
        );

        if(!empty($options['inputDefaults'])) {
            $options = array_merge($defaultOptions['inputDefaults'], $options['inputDefaults']);
        } else {
            $options = array_merge($defaultOptions, $options);
        }
        return parent::create($model, $options);
    }
}