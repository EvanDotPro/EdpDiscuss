<?php

namespace EdpDiscuss\Model\Thread;

use ZfcBase\Mapper\DbMapperAbstract,
    EdpDiscuss\Module as EdpDiscuss,
    Zend\Db\Sql\Select;

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

        if (count($rowset) === 0) {
            return false;
        }

        $row = $rowset->current();

        $threadClass = EdpDiscuss::getOption('thread_model_class');
        $thread = $threadClass::fromArray($row->getArrayCopy());

        return $thread;
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
            $rowset = $this->getTableGateway()->selectWith($select);
        } else {
            $rowset = $this->getTableGateway()->select();
        }

        if (count($rowset) === 0) {
            return false;
        }

        $threadClass = EdpDiscuss::getOption('thread_model_class');
        $threads = $threadClass::fromArraySet($rowset->toArray());

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

