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
    protected $slug;

    /**
     * @var Slugifier
     */
    protected $slugifier;

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
}
