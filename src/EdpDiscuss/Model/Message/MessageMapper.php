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
        return $this->select(array($this->messageIDField => $messageId))->current();
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
        return $this->select(array($this->threadIDField => $threadId));
    }

    /**
     * persist
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function persist(MessageInterface $message)
    {
        if ($message->getMessageId() > 0) {
            $this->update($message);
        } else {
            $this->insert($message);
        }

        return $message;
    }

    public function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {
        $result = $this->insert($entity, $tableName, $hydrator);
        $entity->setMessageId($result->getGeneratedValue());
        return $result;
    }

    public function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'user_id = ' . $entity->getId();
        }

        return parent::update($entity, $where, $tableName, $hydrator);
    }
}
