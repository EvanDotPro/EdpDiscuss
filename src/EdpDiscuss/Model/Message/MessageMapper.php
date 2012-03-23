<?php

namespace EdpDiscuss\Model\Message;

use ZfcBase\Mapper\DbMapperAbstract,
    EdpDiscuss\Module as EdpDiscuss;

class MessageMapper extends DbMapperAbstract implements MessageMapperInterface
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
        $rowset = $this->getTableGateway()->select(array($this->messageIDField => $messageId));
        $row = $rowset->current();

        $messageClass = EdpDiscuss::getOption('message_model_class');
        $message = $messageClass::fromArray($row);

        return $message;
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
        $rowset = $this->getTableGateway()->select(array($this->threadIDField => $threadId));

        $messageClass = EdpDiscuss::getOption('message_model_class');
        $messages = $messageClass::fromArraySet($rowset->toArray());

        return $messages;
    }

    /**
     * persist
     *
     * @param MessageInterface $message
     * @return MessageInterface
     */
    public function persist(MessageInterface $message)
    {
        $data = new ArrayObject($message->toArray());
        if ($message->getMessageId() > 0) {
            $this->getTableGateway()->update((array) $data, array($this->messageIDField => $message->getMessageId()));
        } else {
            $this->getTableGateway()->insert((array) $data);
            $messageId = $this->getTableGateway()->getAdapter()->getDriver()->getConnection()->getLastGeneratedId();
            $message->setMessageId($messageId);
        }

        return $message;
    }
}
