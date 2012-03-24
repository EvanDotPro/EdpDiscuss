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
     * @return ThreadInterface
     */
    public function persist(ThreadInterface $thread);
}
