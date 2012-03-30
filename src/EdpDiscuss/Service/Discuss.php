<?php

namespace EdpDiscuss\Service;

use EdpDiscuss\Model\Message\MessageInterface,
    EdpDiscuss\Model\Message\MessageMapperInterface,
    EdpDiscuss\Model\Thread\ThreadInterface,
    EdpDiscuss\Model\Thread\ThreadMapperInterface,
    ZfcUser\Module as ZfcUser;

class Discuss {

    /**
     * @var ThreadMapperInterface
     */
    protected $threadMapper;

    /**
     * @var MessageMapperInterface
     */
    protected $messageMapper;

    public function getLatestThreads($limit = 25, $offset = 0)
    {
        return $this->threadMapper->getLatestThreads($limit, $offset);
    }

    public function getMessagesByThread(ThreadInterface $thread, $limit = 25, $offset = 0)
    {
        return $this->messageMapper->getMessagesByThread($thread->getThreadId(), $limit, $offset);
    }

    public function createThread(ThreadInterface $thread)
    {
        return $this->threadMapper->persist($thread);
    }

    public function updateThread(ThreadInterface $thread)
    {
        return $this->threadMapper->persist($thread);
    }

    public function createMessage(MessageInterface $message)
    {
        return $this->messageMapper->persist($message);
    }

    public function updateMessage(MessageInterface $message)
    {
        return $this->messageMapper->persist($message);
    }
 
    /**
     * getThreadMapper
     *
     * @return ThreadMapperInterface
     */
    public function getThreadMapper()
    {
        return $this->threadMapper;
    }
 
    /**
     * setThreadMapper
     *
     * @param ThreadMapperInterface $threadMapper
     * @return Discuss
     */
    public function setThreadMapper($threadMapper)
    {
        $this->threadMapper = $threadMapper;
        return $this;
    }
 
    /**
     * getMessageMapper
     *
     * @return MessageMapperInterface
     */
    public function getMessageMapper()
    {
        return $this->messageMapper;
    }
 
    /**
     * setMessageMapper
     *
     * @param MessageMapperInterface $messageMapper
     * @return Discuss
     */
    public function setMessageMapper($messageMapper)
    {
        $this->messageMapper = $messageMapper;
        return $this;
    }
}
