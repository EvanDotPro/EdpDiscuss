<?php

namespace EdpDiscuss\Model\Message;

interface MessageMapperInterface
{
    /**
     * getMessagesByThread
     * 
     * @param int $threadId 
     * @param int $limit 
     * @param int $offest 
     * @return array of EdpDiscuss\Model\Message\MessageInterface's
     */
    public function getMessagesByThread($threadId, $limit = 25, $offest = 0);
}
