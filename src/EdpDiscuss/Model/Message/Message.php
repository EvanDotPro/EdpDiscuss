<?php

namespace EdpDiscuss\Model\Message;

use ZfcUser\Model\UserInterface;
use DateTime;

class Message implements MessageInterface
{
    /**
     * @var int
     */
    protected $messageId;

    /**
     * @var DateTime
     */
    protected $postTime;

    /**
     * @var string
     */
    protected $authorName;

    /**
     * @var string
     */
    protected $authorEmail;

    /**
     * @var UserInterface
     */
    protected $authorUser;

    /**
     * @var ThreadInterface
     */
    protected $thread;
    
    /**
     * @var string
     */
    protected $subject;
    
    /**
     * @var string
     */
    protected $message;

    /**
     * @var int
     */
    protected $parentMessageId;

    /**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setMessageId($messageId)
    {
        $this->messageId = $messageId;
        return $this;
    }

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getPostTime()
    {
        return $this->postTime;
    }

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setPostTime($postTime)
    {
        if ($postTime instanceof DateTime) {
            $this->postTime = $postTime;
        } else {
            $this->postTime = new DateTime($postTime);
        }
        return $this;
    }

    /**
     * Get authorName.
     *
     * @return sring
     */
    public function getAuthorName()
    {
        return $this->authorName;
    }

    /**
     * Set authorName.
     *
     * @param string $authorName the value to be set
     */
    public function setAuthorName($authorName)
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
     * Get authorEmail.
     *
     * @return string
     */
    public function getAuthorEmail()
    {
        return $this->authorEmail;
    }

    /**
     * Set authorEmail.
     *
     * @param string $authorEmail the value to be set
     */
    public function setAuthorEmail($authorEmail)
    {
        $this->authorEmail = $authorEmail;
        return $this;
    }

    /**
     * Get authorUser.
     *
     * @return UserInterface
     */
    public function getAuthorUser()
    {
        return $this->authorUser;
    }

    /**
     * Set authorUser.
     *
     * @param UserInterface $authorUser the value to be set
     */
    public function setAuthorUser(UserInterface $authorUser)
    {
        $this->authorUser = $authorUser;
        return $this;
    }

    /**
     * Get thread.
     *
     * @return ThreadInterface
     */
    public function getThread()
    {
        return $this->thread;
    }
    
    /**
     * Set thread.
     *
     * @param ThreadInterface $thread the value to be set
     */
    public function setThread($thread)
    {
        $this->thread = $thread;
        return $this;
    }
    
    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }
    
    /**
     * Set subject.
     *
     * @param string $subject the value to be set
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }
    
    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * Get parentMessageId.
     *
     * @return int
     */
    public function getParentMessageId()
    {
        return $this->parentMessageId;
    }

    /**
     * Set parentMessageId.
     *
     * @param int $parentMessageId the value to be set
     */
    public function setParentMessageId($parentMessageId)
    {
        $this->parentMessageId = $parentMessageId;
        return $this;
    }
}
