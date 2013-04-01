<?php

namespace EdpDiscuss\Model\Message;

use Zend\Stdlib\Hydrator\ClassMethods;
use EdpDiscuss\Model\Message\MessageInterface;
use ZfcUser\Entity\UserInterface;

class MessageHydrator extends ClassMethods
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
        if (!$object instanceof MessageInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of EdpDiscuss\Model\Message\MessageInterface');
        }
        $data = parent::extract($object);
        
        $user = $object->getAuthorUser();
        if (!$user instanceof UserInterface) {
            unset($data['author_user']);
        }
        
        $thread = $object->getThread();
        $data['thread_id'] = (int)$thread->getThreadId();
        unset($data['thread']);
        
        
        $data['post_time'] = $data['post_time']->format('Y-m-d H:i:s');
            
        //die(var_dump($data));
        
        // Example of how to map fields.
        //$data = $this->mapField('id', 'user_id', $data);
        
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
        if (!$object instanceof MessageEntityInterface) {
            throw new Exception\InvalidArgumentException('$object must be an instance of EdpDiscuss\Model\Message\MessageInterface');
        }
        
        // example of mapping a field
        $data = $this->mapField('user_id', 'id', $data);
        
        return parent::hydrate($data, $object);
    }

    protected function mapField($keyFrom, $keyTo, array $array)
    {
        $array[$keyTo] = $array[$keyFrom];
        unset($array[$keyFrom]);
        return $array;
    }
}
