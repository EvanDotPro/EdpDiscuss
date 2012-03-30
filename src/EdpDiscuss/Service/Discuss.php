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

    /**
     * getLatestThreads 
     * 
     * @param int $limit 
     * @param int $offset 
     * @return array
     */
    public function getLatestThreads($limit = 25, $offset = 0)
    {
        return $this->threadMapper->getLatestThreads($limit, $offset);
    }

    /**
     * getMessagesByThread 
     * 
     * @param ThreadInterface $thread 
     * @param int $limit 
     * @param int $offset 
     * @return array
     */
    public function getMessagesByThread(ThreadInterface $thread, $limit = 25, $offset = 0)
    {
        return $this->messageMapper->getMessagesByThread($thread->getThreadId(), $limit, $offset);
    }

    /**
     * createThread 
     * 
     * @param ThreadInterface $thread 
     * @return ThreadInterface
     */
    public function createThread(ThreadInterface $thread)
    {
        $result = $this->threadMapper->persist($thread);
        $this->events()->trigger(__FUNCTION__, $this, array('thread' => $thread));
        return $result;
    }

    /**
     * updateThread 
     * 
     * @param ThreadInterface $thread 
     * @return ThreadInterface
     */
    public function updateThread(ThreadInterface $thread)
    {
        return $this->threadMapper->persist($thread);
    }

    /**
     * createMessage 
     * 
     * @param MessageInterface $message 
     * @return MessageInterface
     */
    public function createMessage(MessageInterface $message)
    {
        $result = $this->messageMapper->persist($message);
        $this->events()->trigger(__FUNCTION__, $this, array('message' => $message));
        return $result;
    }

    /**
     * updateMessage 
     * 
     * @param MessageInterface $message 
     * @return MessageInterface
     */
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
