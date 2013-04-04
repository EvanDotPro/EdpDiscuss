<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use Zend\Db\Sql\Select;
use EdpDiscuss\Service\DbAdapterAwareInterface;

class ThreadMapper extends AbstractDbMapper implements ThreadMapperInterface, DbAdapterAwareInterface
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
        $select = $this->getSelect()
                       ->where(array($this->threadIDField => $threadId));
        return $this->select($select)->current();
    }

    /**
     * getLatestThreads
     *
     * @param int $limit
     * @param int $offset
     * @return array of ThreadInterface's
     */
    public function getLatestThreads($limit = 25, $offset = 0, $tagId = false)
    {
        if ($tagId) {
            $select = new Select();
            // @TODO: Join the original and latest messages
            $select->from('discuss_thread')
                   ->join('discuss_thread_tag', 'discuss_thread_tag.thread_id = discuss_thread.thread_id')
                   ->where(array('tag_id = ?' => $tagId));
            $rowset = $this->select($select);
        } else {
            $rowset = $this->select();
        }

        return $rowset;
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

