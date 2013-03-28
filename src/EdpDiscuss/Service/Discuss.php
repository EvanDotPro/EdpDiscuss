<?php

namespace EdpDiscuss\Service;

use EdpDiscuss\Model\Message\MessageInterface,
    EdpDiscuss\Model\Message\MessageMapperInterface,
    EdpDiscuss\Model\Thread\ThreadInterface,
    EdpDiscuss\Model\Thread\ThreadMapperInterface,
    EdpDiscuss\Model\Tag\TagInterface,
    EdpDiscuss\Model\Tag\TagMapperInterface,
    ZfcUser\Module as ZfcUser,
    Zend\ServiceManager\ServiceManagerAwareInterface,
    Zend\ServiceManager\ServiceManager;

class Discuss implements ServiceManagerAwareInterface
{
    /**
     * @var ServiceManager
     */
    protected $serviceManager;
    
    /**
     * @var ThreadMapperInterface
     */
    protected $threadMapper;

    /**
     * @var MessageMapperInterface
     */
    protected $messageMapper;

    /**
     * @var TagMapperInterface
     */
    protected $tagMapper;

    /**
     * Retrieve service manager instance
     *
     * @return ServiceManager
     */
    public function getServiceManager()
    {
        return $this->serviceManager;
    }
    
    /**
     * Set service manager instance
     *
     * @param ServiceManager $serviceManager
     * @return Discuss
     */
    public function setServiceManager(ServiceManager $serviceManager)
    {
        $this->serviceManager = $serviceManager;
        return $this;
    }
    
    /**
     * getLatestThreads
     *
     * @param int $limit
     * @param int $offset
     * @param int $tagId
     * @return array
     */
    public function getLatestThreads($limit = 25, $offset = 0, $tagId = false)
    {
        return $this->threadMapper->getLatestThreads($limit, $offset, $tagId);
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
    public function createThread(ThreadInterface $thread, MessageInterface $message)
    {
        $message = $this->messageMapper->persist($message);

        $thread->setOriginalMessage($message);
        $thread = $this->threadMapper->persist($thread);

        $this->events()->trigger(__FUNCTION__, $this, array('thread' => $thread));

        return $thread;
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
     * @param array $data
     * @return MessageInterface
     */
    public function createMessage(array $data, $thread)
    {   
        // Create new message object.
        $message = $this->getServiceManager()->get('edpdiscuss_message');
        $message->setThread($thread);
                
        // Create new form and hydrator objects.
        $form = $this->getServiceManager()->get('edpdiscuss_form');
        $formHydrator = $this->getServiceManager()->get('edpdiscuss_post_form_hydrator');
        
        // validate data against form
        $form->setHydrator($formHydrator);
        $form->bind($message);
        $form->setData($data);
        if (!$form->isValid())
        {
            return false;
        }
        
        // Valid, so persist message.
        $message->setPostTime(new \DateTime);
        $message = $this->messageMapper->persist($message);
     //   $this->events()->trigger(__FUNCTION__, $this, array('message' => $message));
        return $message;
    }

    /**
     * updateMessage
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function updateMessage(MessageInterface $message)
    {   
        $message->setPostTime(new \DateTime);
        return $this->messageMapper->persist($message); 
    }

    /**
     * getTagById
     *
     * @param int $tagId
     * @return TagInterface
     */
    public function getTagById($tagId)
    {
        return $this->tagMapper->getTagById($tagId);
    }

    /**
     * getThreadById
     *
     * @param int $threadId
     * @return ThreadInterface
     */
    public function getThreadById($threadId)
    {
        return $this->threadMapper->getThreadById($threadId);
    }

    /**
     * getMessageById
     * 
     * @param int $messageId
     * @return MessageInterface
     */
    public function getMessageById($messageId)
    {
        return $this->messageMapper->getMessageById($messageId);
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

    /**
     * Get tagMapper.
     *
     * @return tagMapper
     */
    public function getTagMapper()
    {
        return $this->tagMapper;
    }

    /**
     * Set tagMapper.
     *
     * @param TagMapperInterface $tagMapper the value to be set
     */
    public function setTagMapper(TagMapperInterface $tagMapper)
    {
        $this->tagMapper = $tagMapper;
        return $this;
    }
}
