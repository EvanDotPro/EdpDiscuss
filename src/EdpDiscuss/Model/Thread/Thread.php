<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Model\ModelAbstract,
    EdpDiscuss\Model\Message\MessageInterface;

class Thread extends ModelAbstract implements ThreadInterface
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
     * @var MessageInterface
     */
    protected $originalMessage;

    /**
     * @var MessageInterface
     */
    protected $latestMessage;

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
}
