<?php

namespace EdpDiscuss\Model\Message;

use ZfcBase\Mapper\DbMapperAbstract;

class MessageMapper extends DbMapperAbstract implements MessageMapperInterface
{
    protected $tableName = 'discuss_message';

}
