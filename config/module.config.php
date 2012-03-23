<?php
return array(
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
