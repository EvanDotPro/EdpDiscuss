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

                // Default Zend\Db
                'edpdiscuss_zend_db_adapter'    => 'Zend\Db\Adapter\Adapter',
                'edpdiscuss_thread_mapper'      => 'EdpDiscuss\Model\Thread\ThreadMapper',
                'edpdiscuss_message_mapper'     => 'EdpDiscuss\Model\Message\MessageMapper',
                'edpdiscuss_thread_tg'          => 'Zend\Db\TableGateway\TableGateway',
                'edpdiscuss_message_tg'         => 'Zend\Db\TableGateway\TableGateway',
            ),
            'edpdiscuss' => array(
                'parameters' => array(
                    'discussService' => 'EdpDiscuss\Service\Discuss'
                )
            ),
            'EdpDiscuss\Service\Discuss' => array(
                'parameters' => array(
                    'threadMapper'  => 'edpdiscuss_thread_mapper',
                    'messageMapper' => 'edpdiscuss_message_mapper',
                )
            ),
            'EdpDiscuss\Model\Thread\ThreadMapper' => array(
                'parameters' => array(
                    'tableGateway' => 'edpdiscuss_thread_tg'
                ),
            ),
            'EdpDiscuss\Model\Message\MessageMapper' => array(
                'parameters' => array(
                    'tableGateway' => 'edpdiscuss_message_tg'
                ),
            ),
            'edpdiscuss_thread_tg' => array(
                'parameters' => array(
                    'tableName' => 'discuss_thread',
                    'adapter'   => 'edpdiscuss_zend_db_adapter',
                ),
            ),
            'edpdiscuss_message_tg' => array(
                'parameters' => array(
                    'tableName' => 'discuss_message',
                    'adapter'   => 'edpdiscuss_zend_db_adapter',
                ),
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
