<?php

namespace EdpDiscuss\Model\Message;

use ZfcUser\Model\UserInterface,
    DateTime;

interface MessageInterface
{
    /**
     * Get messageId.
     *
     * @return int
     */
    public function getMessageId();

    /**
     * Set messageId.
     *
     * @param int $messageId the value to be set
     */
    public function setMessageId($messageId);

    /**
     * Get postTime.
     *
     * @return DateTime
     */
    public function getPostTime();

    /**
     * Set postTime.
     *
     * @param mixed $postTime the value to be set
     */
    public function setPostTime($postTime);

    /**
     * Get authorName.
     *
     * @return sring
     */
    public function getAuthorName();

    /**
     * Set authorName.
     *
     * @param string $authorName the value to be set
     */
    public function setAuthorName($authorName);

    /**
     * Get authorEmail.
     *
     * @return string
     */
    public function getAuthorEmail();

    /**
     * Set authorEmail.
     *
     * @param string $authorEmail the value to be set
     */
    public function setAuthorEmail($authorEmail);

    /**
     * Get authorUser.
     *
     * @return UserInterface
     */
    public function getAuthorUser();

    /**
     * Set authorUser.
     *
     * @param UserInterface $authorUser the value to be set
     */
    public function setAuthorUser(UserInterface $authorUser);

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject();
    
    /**
     * Set subject.
     *
     * @param string $subject the value to be set
    */
    public function setSubject($subject);
    
    /**
     * Get message.
     *
     * @return string
     */
    public function getMessage();

    /**
     * Set message.
     *
     * @param string $message the value to be set
     */
    public function setMessage($message);

    /**
     * Get parentMessageId.
     *
     * @return int
     */
    public function getParentMessageId();

    /**
     * Set parentMessageId.
     *
     * @param int $parentMessageId the value to be set
     */
    public function setParentMessageId($parentMessageId);
}
