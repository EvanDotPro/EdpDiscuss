<?php

namespace EdpDiscuss\Model\Visit;

use ZfcBase\Mapper\AbstractDbMapper;
use EdpDiscuss\Service\DbAdapterAwareInterface;

class VisitMapper extends AbstractDbMapper implements VisitMapperInterface, DbAdapterAwareInterface
{
    protected $tableName = 'discuss_visit';
    
    public function storeVisitIfUnique($visit)
    {
        $select = $this->getSelect()
                       ->where(array(
                           'ip_address' => $visit->getIpAddress(),
                           'thread_id' => $visit->getThread()->getThreadId()
                       ));
        $result = $this->select($select)->current();
        if (!$result) {
            parent::insert($visit, null, new VisitHydrator);
            return true;
        } else {
            return false;
        }
    }
}