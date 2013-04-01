<?php

namespace EdpDiscuss\Form;

use Zend\Form\Form;

class PostForm extends Form
{
    public function __construct()
    {
        parent::__construct();
        
        $this->add(array(
                'name' => 'thread_id',
                'options' => array(
                        'label' => '',
                ),
                'attributes' => array(
                        'type' => 'hidden',
                ),
        ));
        
        $this->add(array(
                'name' => 'subject',
                'options' => array(
                        'label' => 'Subject',
                ),
                'attributes' => array(
                        'type' => 'text',
                ),
        ));
        
        $this->add(array(
                'name' => 'message',
                'options' => array(
                        'label' => 'Message',
                ),
                'attributes' => array(
                        'type' => 'text',
                ),
        ));
        
        // Submit button.
        $this->add(array(
            'name' => 'submit',
            'attributes' => array(
                'type'  => 'submit',
                'value' => 'Post',
                'id'    => 'submitbutton',
                'class' => 'btn btn-primary'
            ),
        ));
    }
}
