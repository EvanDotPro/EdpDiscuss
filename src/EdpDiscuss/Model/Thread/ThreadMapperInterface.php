<?php

namespace EdpDiscuss\Model\Thread;

interface ThreadMapperInterface
{
    /**
     * getThreadById 
     * 
     * @param int $threadId 
     * @return ThreadInterface
     */
    public function getThreadById($threadId);

    /**
     * getThreadMessages 
     * 
     * @param int $threadId 
     * @param int $limit 
     * @param int $offest 
     * @return array of EdpDiscuss\Model\Message\MessageInterface's
     */
    public function getThreadMessages($threadId, $limit = 25, $offest = 0);

    /**
     * getLatestThreads 
     * 
     * @param int $limit 
     * @param int $offset 
     * @return array of ThreadInterface's
     */
    public function getLatestThreads($limit = 25, $offset = 0);

    /**
     * persist 
     * 
     * @param ThreadInterface $thread 
     * @return bool
     */
    public function persist(ThreadInterface $thread);
}
