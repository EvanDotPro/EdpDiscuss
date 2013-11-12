<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Model\ModelAbstract;
use BaconStringUtils\Slugifier;
use EdpDiscuss\Model\Message\MessageInterface;
use DateTime;

class Thread implements ThreadInterface
{
    /**
     * @var int
     */
    protected $threadId;

    /**
     * @var string
     */
    protected $subject;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var MessageInterface
     */
    protected $originalMessage;

    /**
     * @var MessageInterface
     */
    protected $latestMessage;

    /**
     * @var Slugifier
     */
    protected $slugifier;

    /**
     * @var integer
     */
    protected $messageCount;
    
    /**
     * @var integer
     */
    protected $visitCount;
    
    /**
     * @var Date
     */
    protected $lastPost;
    
    /**
     * Get threadId.
     *
     * @return threadId
     */
    public function getThreadId()
    {
        return $this->threadId;
    }

    /**
     * Set threadId.
     *
     * @param $threadId the value to be set
     */
    public function setThreadId($threadId)
    {
        $this->threadId = $threadId;
        return $this;
    }

    /**
     * Get subject.
     *
     * @return subject
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set subject.
     *
     * @param $subject the value to be set
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        $this->setSlug($this->getSlugifier()->slugify($subject));
        return $this;
    }

    /**
     * Get slug.
     *
     * @return slug
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set slug.
     *
     * @param $slug the value to be set
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get originalMessage.
     *
     * @return MessageInterface
     */
    public function getOriginalMessage()
    {
        return $this->originalMessage;
    }

    /**
     * Set originalMessage.
     *
     * @param MessageInterface $originalMessage the value to be set
     */
    public function setOriginalMessage(MessageInterface $originalMessage)
    {
        $this->originalMessage = $originalMessage;
        return $this;
    }

    /**
     * Get latestMessage.
     *
     * @return MessageInterface
     */
    public function getLatestMessage()
    {
        return $this->latestMessage;
    }

    /**
     * Set latestMessage.
     *
     * @param MessageInterface $latestMessage the value to be set
     */
    public function setLatestMessage(MessageInterface $latestMessage)
    {
        $this->latestMessage = $latestMessage;
        return $this;
    }

    public function getSlugifier()
    {
        if ($this->slugifier === null) {
            $this->slugifier = new Slugifier;
        }
        return $this->slugifier;
    }

    public function setSlugifier($slugifier)
    {
        $this->slugifier = $slugifier;
        return $this;
    }
    
    /**
     * Set Message Count.
     *
     * @param integer $messageCount
     */
    public function setMessageCount($messageCount)
    {
        $this->messageCount = $messageCount;
        return $this;
    }
    
    /**
     * Get Message Count.
     *
     * @return integer
     */
    public function getMessageCount()
    {
        return $this->messageCount;
    }
    
    /**
     * Set View Count
     * 
     * Enter description here ...
     * @param unknown_type $viewCount
     */
    public function setVisitCount($viewCount)
    {
    	$this->viewCount = $viewCount;
    	return $this;
    }
    
    /**
     * Get View Count
     * 
     * @return integer
     */
    public function getVisitCount()
    {
    	return $this->viewCount;
    }
    
    /**
     * Set Last Post
     *
     * @param DateTime $lastPost
     */
    public function setLastPost($lastPost)
    {
        if ($lastPost instanceof DateTime) {
            $this->lastPost = $lastPost;
        } else {
            $this->lastPost = new DateTime($lastPost);
        }
        return $this;
    }
    
    /**
     * Get Last Post.
     *
     * @return Date
     */
    public function getLastPost()
    {
        return $this->lastPost;
    }
}
