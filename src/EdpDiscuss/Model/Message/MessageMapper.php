<?php

namespace EdpDiscuss\Model\Message;

use ZfcBase\Mapper\DbMapperAbstract;

class MessageMapper extends DbMapperAbstract implements MessageMapperInterface
{
    protected $tableName = 'discuss_message';

    /**
     * getThreadMessages 
     * 
     * @param int $threadId 
     * @param int $limit 
     * @param int $offest 
     * @return array of EdpDiscuss\Model\Message\MessageInterface's
     */
    public function getMessageByThread($threadId, $limit = 25, $offest = 0)
    {

    }
}
