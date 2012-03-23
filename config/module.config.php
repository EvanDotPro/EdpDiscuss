<?php
return array(
    'edpdiscuss' => array(
        'thread_model_class'    => 'EdpDiscuss\Model\Thread\Thread',
        'message_model_class'   => 'EdpDiscuss\Model\Message\Message'
    ),
    'di' => array(
        'instance' => array(
            'alias' => array(
                'edpdiscuss' => 'EdpDiscuss\Controller\IndexController',
            ),

            'Zend\View\Resolver\TemplatePathStack' => array(
                'parameters' => array(
                    'paths'  => array(
                        'edpdiscuss' => __DIR__ . '/../view',
                    ),
                ),
            ),
        ),
    ),
);
