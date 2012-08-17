<?php

namespace EdpDiscuss\Model\Tag;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Module as EdpDiscuss;
use EdpDiscuss\Service\DbAdapterAwareInterface;

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
        return $this->select(array('tag_id' => $tagId))->current();
    }
}
