<?php

namespace EdpDiscuss\Model\Visit;

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
    public function setThread($thread);
    
    /**
     * getThread
     */
    public function getThread();
}