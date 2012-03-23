<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Mapper\DbMapperAbstract;

class ThreadMapper extends DbMapperAbstract implements ThreadMapperInterface
{
    protected $tableName = 'discuss_thread';
    protected $threadIDField = 'thread_id';

    /**
     * getThreadById 
     * 
     * @param int $threadId 
     * @return ThreadInterface
     */
    public function getThreadById($threadId)
    {
        $rowset = $this->getTableGateway()->select(array($this->threadIDField => $threadId));
        $row = $rowset->current();

        $threadClass = EdpDiscuss::getOption('thread_model_class');
        $thread = $threadClass::fromArray($row);

        return $thread;
    }

    /**
     * getLatestThreads 
     * 
     * @param int $limit 
     * @param int $offset 
     * @return array of ThreadInterface's
     */
    public function getLatestThreads($limit = 25, $offset = 0)
    {
        $rowset = $this->getTableGateway()->select();

        $threadClass = EdpDiscuss::getOption('thread_model_class');
        $threads = $threadClass::fromArraySet($rowset);

        return $threads;
    }

    /**
     * persist 
     * 
     * @param ThreadInterface $thread 
     * @return ThreadInterface
     */
    public function persist(ThreadInterface $thread)
    {
        $data = new ArrayObject($thread->toArray());
        if ($thread->getThreadId() > 0) {
            $this->getTableGateway()->update((array) $data, array($this->threadIDField => $thread->getThreadId()));
        } else {
            $this->getTableGateway()->insert((array) $data);
            $threadId = $this->getTableGateway()->getAdapter()->getDriver()->getConnection()->getLastGeneratedId();
            $thread->setThreadId($threadId);
        }

        return $thread;
    }
}

