<?php

namespace EdpDiscuss\Model\Visit;

use EdpDiscuss\Model\Thread\ThreadInterface;

class Visit implements VisitInterface
{
    /**
     * @var string
     */
    protected $ipAddress;
    
    /**
     * @var DateTime
     */
    protected $visitTime;
    
    /**
     * @var ThreadInterface
     */
    protected $thread;
    
    /**
     * setIpAddress - Sets the IP address.
     * 
     * @param unknown_type $ipAddress
     * @return \EdpDiscuss\Model\Visit\Visit
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
        return $this;
    }
    
    /**
     * getIpAddress - Returns the IP address.
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }
    
    /**
     * setVisitTime - Sets the visit time.
     * 
     * @param unknown_type $visitTime
     * @return \EdpDiscuss\Model\Visit\Visit
     */
    public function setVisitTime($visitTime)
    {
        if ($visitTime instanceof \DateTime) {
            $this->visitTime = $visitTime;
        } else {
            $this->visitTime = new \DateTime($visitTime);
        }
        return $this;
    }
    
    /**
     * getVisitTime - returns the visit time.
     */
    public function getVisitTime()
    {
        return $this->visitTime;
    }
    
    /**
     * setThread - Sets the thread.
     * 
     * @param ThreadInterface $thread
     * @return \EdpDiscuss\Model\Visit\Visit
     */
    public function setThread(ThreadInterface $thread)
    {
        $this->thread = $thread;
        return $this;
    }
    
    /**
     * getThread - returns the thread.
     */
    public function getThread()
    {
        return $this->thread;
    }
}
