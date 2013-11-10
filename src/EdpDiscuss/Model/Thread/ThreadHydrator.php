<?php

namespace EdpDiscuss\Model\Thread;

use Zend\Stdlib\Hydrator\ClassMethods;
use EdpDiscuss\Model\Thread\ThreadInterface;

class ThreadHydrator extends ClassMethods
{
    /**
     * Extract values from an object
     *
     * @param  object $object
     * @return array
     * @throws Exception\InvalidArgumentException
     */
    public function extract($object)
    {
        if (!$object instanceof ThreadInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of EdpDiscuss\Model\Thread\ThreadInterface');
        }
        $data = parent::extract($object);
        unset($data['original_message']);
        unset($data['latest_message']);
        unset($data['slugifier']);
        unset($data['message_count']);
        unset($data['last_post']);
        return $data;
    }

    /**
     * Hydrate $object with the provided $data.
     *
     * @param  array $data
     * @param  object $object
     * @return MessageInterface
     * @throws Exception\InvalidArgumentException
     */
    public function hydrate(array $data, $object)
    {
        if (!$object instanceof ThreadInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of EdpDiscuss\Model\Thread\ThreadInterface');
        }
        return parent::hydrate($data, $object);
    }
}
