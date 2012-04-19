<?php

namespace EdpDiscuss\Model\Thread;

use EdpDiscuss\Model\Message\MessageInterface;

interface ThreadInterface
{
    /**
     * Get threadId.
     *
     * @return threadId
     */
    public function getThreadId();

    /**
     * Set threadId.
     *
     * @param $threadId the value to be set
     */
    public function setThreadId($threadId);

    /**
     * Get subject.
     *
     * @return subject
     */
    public function getSubject();

    /**
     * Set subject.
     *
     * @param $subject the value to be set
     */
    public function setSubject($subject);

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

    /**
     * Get originalMessage.
     *
     * @return MessageInterface
     */
    public function getOriginalMessage();

    /**
     * Set originalMessage.
     *
     * @param MessageInterface $originalMessage the value to be set
     */
    public function setOriginalMessage(MessageInterface $originalMessage);

    /**
     * Get latestMessage.
     *
     * @return MessageInterface
     */
    public function getLatestMessage();

    /**
     * Set latestMessage.
     *
     * @param MessageInterface $latestMessage the value to be set
     */
    public function setLatestMessage(MessageInterface $latestMessage);
}
