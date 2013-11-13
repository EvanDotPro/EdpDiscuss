<?php

namespace EdpDiscuss\Model\Visit;

use EdpDiscuss\Model\Thread\ThreadInterface;

interface VisitInterface
{
    /**
     * setIpAddress
     * 
     * @param unknown_type $ipAddress
     */
    public function setIpAddress($ipAddress);
    
    /**
     * getIpAddress
     */
    public function getIpAddress();
    
    /**
     * setVisitTime
     * 
     * @param unknown_type $visitTime
     */
    public function setVisitTime($visitTime);
    
    /**
     * getVisitTime
     */
    public function getVisitTime();
    
    /**
     * setThread
     * 
     * @param unknown_type $thread
     */
    public function setThread(ThreadInterface $thread);
    
    /**
     * getThread
     */
    public function getThread();
}