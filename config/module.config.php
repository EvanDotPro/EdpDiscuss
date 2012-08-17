<?php
return array(
    'edpdiscuss' => array(
        'thread_model_class'  => 'EdpDiscuss\Model\Thread\Thread',
        'message_model_class' => 'EdpDiscuss\Model\Message\Message',
        'tag_model_class'     => 'EdpDiscuss\Model\Tag\Tag',
    ),
    'service_manager' => array(
        'aliases' => array(
            'edpdiscuss_zend_db_adapter' => 'Zend\Db\Adapter\Adapter',
        ),
    ),
);
