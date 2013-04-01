<?php

namespace EdpDiscuss;

use Zend\ModuleManager\ModuleManager;

class Module
{
    protected static $options;

    public function init(ModuleManager $moduleManager)
    {
        $moduleManager->getEventManager()->attach('loadModules.post', array($this, 'modulesLoaded'));
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

    public function getServiceConfig()
    {
        return array(
            'invokables' => array(
                'edpdiscuss_post_form_hydrator' => 'Zend\Stdlib\Hydrator\ClassMethods'
            ),
            'factories' => array(
                'edpdiscuss_discuss_service' => function($sm) {
                    $service = new \EdpDiscuss\Service\Discuss;
                    $service->setThreadMapper($sm->get('edpdiscuss_thread_mapper'))
                            ->setMessageMapper($sm->get('edpdiscuss_message_mapper'))
                            ->setTagMapper($sm->get('edpdiscuss_tag_mapper'));
                    return $service;
                },
                'edpdiscuss_thread_mapper' => function($sm) {
                    $mapper = new \EdpDiscuss\Model\Thread\ThreadMapper;
                    //$threadModelClass = static::getOption('thread_model_class');
                    $threadModelClass = Module::getOption('thread_model_class');
                    $mapper->setEntityPrototype(new $threadModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;

                },
                'edpdiscuss_tag_mapper' => function($sm) {
                    $mapper = new \EdpDiscuss\Model\Tag\TagMapper;
                    //$tagModelClass = static::getOption('tag_model_class');
                    $tagModelClass = Module::getOption('tag_model_class');
                    $mapper->setEntityPrototype(new $tagModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'edpdiscuss_message_mapper' => function($sm) {
                    $mapper = new \EdpDiscuss\Model\Message\MessageMapper;
                    //$messageModelClass = static::getOption('message_model_class');
                    $messageModelClass = Module::getOption('message_model_class');
                    $mapper->setEntityPrototype(new $messageModelClass);
                    $mapper->setHydrator(new \Zend\Stdlib\Hydrator\ClassMethods);
                    return $mapper;
                },
                'edpdiscuss_message' => function ($sm) {
                    $message = new \EdpDiscuss\Model\Message\Message;
                    return $message;
                },
                'edpdiscuss_form' => function ($sm) {
                    $form = new \EdpDiscuss\Form\PostForm;
                    return $form;
                },
            ),
            'initializers' => array(
                function($instance, $sm){
                    if($instance instanceof Service\DbAdapterAwareInterface){
                        $dbAdapter = $sm->get('edpdiscuss_zend_db_adapter');
                        return $instance->setDbAdapter($dbAdapter);
                    }
                },
            ),


            //'EdpDiscuss\Service\Discuss' => array(
            //    'parameters' => array(
            //        'threadMapper'  => 'edpdiscuss_thread_mapper',
            //        'messageMapper' => 'edpdiscuss_message_mapper',
            //        'tagMapper'     => 'edpdiscuss_tag_mapper',
            //    )
            //),
        );

    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function modulesLoaded($e)
    {
        $config = $e->getConfigListener()->getMergedConfig();
        static::$options = $config['edpdiscuss'];
    }

    /**
     * @TODO: Come up with a better way of handling module settings/options
     */
    public static function getOption($option)
    {
        if (!isset(static::$options[$option])) {
            return null;
        }
        return static::$options[$option];
    }
}
