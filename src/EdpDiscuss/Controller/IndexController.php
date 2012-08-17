<?php

namespace EdpDiscuss\Controller;

use Zend\Mvc\Controller\ActionController,
    Zend\View\Model\ViewModel,
    EdpDiscuss\Service\Discuss as DiscussService;

class IndexController extends ActionController
{

    /**
     * discussService
     *
     * @var Discuss
     */
    protected $discussService;

    public function indexAction()
    {
        var_dump($this->discussService->getLatestThreads());
        return new ViewModel();
    }

    /**
     * Get discussService.
     *
     * @return discussService
     */
    public function getDiscussService()
    {
        return $this->discussService;
    }

    /**
     * Set discussService.
     *
     * @param $discussService the value to be set
     */
    public function setDiscussService($discussService)
    {
        $this->discussService = $discussService;
        return $this;
    }
}
