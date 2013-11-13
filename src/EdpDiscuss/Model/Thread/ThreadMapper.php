<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Expression;
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
        $select = $this->getSelect();
        $select->join(array('tt' => 'discuss_thread_tag'),
                      'tt.thread_id = discuss_thread.thread_id',
                      array())
                ->join(array('m' => 'discuss_message'),
                       'm.thread_id = discuss_thread.thread_id',
                       array(
                           'message_count' => new Expression('COUNT(DISTINCT m.message_id)'),
                           'last_post' => new Expression('MAX(m.post_time)')
                       ),
                       'left')
                ->join(array('v' => 'discuss_visit'),
                       'v.thread_id = discuss_thread.thread_id',
                       array(
                           'visit_count' => new Expression('COUNT(DISTINCT v.ip_address)')
                       ),
                       'left')
                ->where(array('tag_id = ?' => $tagId))
                ->group(array('discuss_thread.subject', 'discuss_thread.slug'));
        //die($select->getSqlString());    
        return $this->select($select);
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
        //die(var_dump($entity));      
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

