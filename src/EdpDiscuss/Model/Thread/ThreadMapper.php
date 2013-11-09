<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use Zend\Db\Sql\Select;
use EdpDiscuss\Service\DbAdapterAwareInterface;
use Zend\Stdlib\Hydrator\HydratorInterface;

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
     * persist - Persists a thread to the database.
     *
     * @param ThreadInterface $thread
     * @return ThreadInterface
     */
    public function persist(ThreadInterface $thread)
    {
        if ($thread->getThreadId() > 0) {
            $this->update($thread, null, null, new ThreadHydrator);
        } else {
            $this->insert($thread, null, new ThreadHydrator);
        }
        
        return $thread;
    }
    
    /**
     * insert - Inserts a new thread into the database, using the specified hydrator.
     *
     * @param ThreadInterface $entity
     * @param String $tableName
     * @param HydratorInterface $hydrator
     * @return unknown
     */
    protected function insert($entity, $tableName = null, HydratorInterface $hydrator = null)
    {        
        $result = parent::insert($entity, $tableName, $hydrator);
        $entity->setThreadId($result->getGeneratedValue());
        return $result;
    }
    
    /**
     * update - Updates an existing thread in the database.
     * @param ThreadInterface $entity
     * @param String $where
     * @param String $tableName
     * @param HydratorInterface $hydrator
     */
    protected function update($entity, $where = null, $tableName = null, HydratorInterface $hydrator = null)
    {
        if (!$where) {
            $where = 'thread_id = ' . $entity->getThreadId();
        }
        return parent::update($entity, $where, $tableName, $hydrator);
    }
}

