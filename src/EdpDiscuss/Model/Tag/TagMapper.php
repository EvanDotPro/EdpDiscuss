<?php

namespace EdpDiscuss\Model\Tag;

use ZfcBase\Mapper\DbMapperAbstract,
    EdpDiscuss\Module as EdpDiscuss;

class TagMapper extends DbMapperAbstract implements TagMapperInterface
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
        $rowset = $this->getTableGateway()->select(array('tag_id' => $tagId));
        $row = $rowset->current();
        if (!$row) { return false; }

        $tagClass = EdpDiscuss::getOption('tag_model_class');
        $tag = $tagClass::fromArray($row->getArrayCopy());

        return $tag;
    }
}
