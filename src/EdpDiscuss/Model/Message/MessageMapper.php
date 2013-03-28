<?php

namespace EdpDiscuss\Model\Message;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use EdpDiscuss\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

class MessageMapper extends AbstractDbMapper implements MessageMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'discuss_message';
    protected $messageIDField = 'message_id';
    protected $threadIDField = 'thread_id';

    /**
     * getMessageById
     *
     * @param int $messageId
     * @return MessageInterface
     */
    public function getMessageById($messageId)
    {
        $select = $this->getSelect()
                       ->where(array($this->messageIDField => $messageId));
        return $this->select($select)->current();
    }

    /**
     * getMessagesByThread
     *
     * @param int $threadId
     * @param int $limit
     * @param int $offest
     * @return array of EdpDiscuss\Model\Message\MessageInterface's
     */
    public function getMessagesByThread($threadId, $limit = 25, $offset = 0)
    {
        $select = $this->getSelect()
                       ->where(array($this->threadIDField => $threadId));
        return $this->select($select);
    }

    /**
     * persist - persists a message to the database.
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function persist(MessageInterface $message)
    {
        if ($message->getMessageId() > 0) {
            $this->update($message, null, null, new MessageHydrator);
        } else {
            $this->insert($message, null, new MessageHydrator);
        }

        return $message;
    }

    /**
     * insert - Inserts a new message into the database, using the specified hydrator.
     * 
     * @param MessageInterface $entity
     * @param String $tableName
     * @param HydratorInterface $hydrator
     * @return unknown
     */
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setMessageId($result->getGeneratedValue());
        return $result;
    }

    /**
     * update - Updates an existing message in the database.
     * @param MessageInterface $entity
     * @param String $where
     * @param String $tableName
     * @param HydratorInterface $hydrator
     */
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'message_id = ' . $entity->getMessageId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}
