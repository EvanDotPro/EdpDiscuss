<?php

namespace EdpDiscuss\Model\Tag;

interface TagInterface
{
    /**
     * Get tagId.
     *
     * @return tagId
     */
    public function getTagId();

    /**
     * Set tagId.
     *
     * @param $tagId the value to be set
     */
    public function setTagId($tagId);

    /**
     * Get name.
     *
     * @return name
     */
    public function getName();

    /**
     * Set name.
     *
     * @param $name the value to be set
     */
    public function setName($name);

    /**
     * Get slug.
     *
     * @return slug
     */
    public function getSlug();

    /**
     * Set slug.
     *
     * @param $slug the value to be set
     */
    public function setSlug($slug);
}
