<?php

namespace EdpDiscuss\Model\Tag;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use EdpDiscuss\Service\DbAdapterAwareInterface;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Expression;

class TagMapper extends AbstractDbMapper implements TagMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'discuss_tag';

    /**
     * getTagById
     *
     * @param int $tagId
     * @return TagInterface
     */
    public function getTagById($tagId)
    {
        $select = $this->getSelect()
                       ->where(array('tag_id' => $tagId));
        
        return $this->select($select)->current();
    }
    
    /**
     * getTags
     *
     * @return array of TagInterface's
     */
    public function getTags()
    { 
    	$select = $this->getSelect();
    	$select->join(array('tt' => 'discuss_thread_tag'),
    	              'tt.tag_id = discuss_tag.tag_id',
    	              array(),
    	              'left')
               ->join(array('t' => 'discuss_thread'),
                      't.thread_id = tt.thread_id',
                      array('thread_count' => new Expression('COUNT(DISTINCT t.thread_id)')),
                      'left')
               ->join(array('m' => 'discuss_message'),
                      'm.thread_id = t.thread_id',
                      array('last_post' => new Expression('MAX(m.post_time)'),
                            'message_count' => new Expression('COUNT(m.message_id)')),
                      'left')
               ->group(array('discuss_tag.name', 'discuss_tag.slug', 'discuss_tag.description'));
        return $this->select($select);
    }
    
    /**
     * Add Thread.
     * 
     * @param integer $tag_id
     * @param integer $thread_id
     */
    public function addThread($tag_id, $thread_id)
    {
        $sql = new Sql($this->getDbAdapter());
        $insert = $sql->insert();
        $insert->into('discuss_thread_tag');
        $insert->values(array('tag_id' => $tag_id, 'thread_id' => $thread_id));
        $sql->prepareStatementForSqlObject($insert)
            ->execute();
    }
}
