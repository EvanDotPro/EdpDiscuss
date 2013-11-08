<?php

namespace EdpDiscuss\Model\Tag;

use BaconStringUtils\Slugifier;

class Tag implements TagInterface
{
    /**
     * @var int
     */
    protected $tagId;

    /**
     * @var string
     */
    protected $name;
    
    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var Slugifier
     */
    protected $slugifier;

    /**
     * @var integer
     */
    protected $threadCount;
    
    /**
     * @var integer
     */
    protected $messageCount;
    
    /**
     * @var Date
     */
    protected $lastPost;
    
    /**
     * Get tagId.
     *
     * @return tagId
     */
    public function getTagId()
    {
        return $this->tagId;
    }

    /**
     * Set tagId.
     *
     * @param $tagId the value to be set
     */
    public function setTagId($tagId)
    {
        $this->tagId = $tagId;
        return $this;
    }

    /**
     * Get name.
     *
     * @return name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name.
     *
     * @param $name the value to be set
     */
    public function setName($name)
    {
        $this->name = $name;
        $this->setSlug($this->getSlugifier()->slugify($name));
        return $this;
    }

    /**
     * Get description.
     *
     * @return description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set description.
     *
     * @param $description the value to be set
     */
    public function setDescription($description)
    {
        $this->description = $description;
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
     * Set slug. Protected, use setName() instead
     *
     * @param $slug the value to be set
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * Get Slugifier.
     * 
     * @return Slugifier
     */
    public function getSlugifier()
    {
        if ($this->slugifier === null) {
            $this->slugifier = new Slugifier;
        }
        return $this->slugifier;
    }

    /**
     * Set Slugifier.
     * 
     * @param Slugifier
     */
    public function setSlugifier($slugifier)
    {
        $this->slugifier = $slugifier;
        return $this;
    }
    
    /**
     * Set thread count.
     * @param integer $threadCount
     */
    public function setThreadCount($threadCount)
    {
    	$this->threadCount = $threadCount;
    	return $this;
    }
    
    /**
     * Get thread count.
     * 
     * @return integer
     */
    public function getThreadCount()
    {
    	return $this->threadCount;
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
     * Set Last Post
     * 
     * @param Date $lastPost
     */
    public function setLastPost($lastPost)
    {
    	$this->lastPost = $lastPost;
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
