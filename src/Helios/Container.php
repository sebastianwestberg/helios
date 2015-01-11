<?php

namespace Helios;

class Container implements \ArrayAccess
{
    private $storage = array();

    public function __construct()
    {
        // no magic for now
    }

    public function offsetExists($offset)
    {
        return isset($this->storage[$offset]);
    }

    public function offsetGet($offset)
    {
        if (!isset($this->storage[$offset])) {
            throw new \InvalidArgumentException(sprintf("'%s' is not recognized by the container", $offset));
        }

        if (is_object($storageEntry = $this->storage[$offset])) {
            return $storageEntry($this);
        } else {
            return $storageEntry;
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->storage[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        if (isset($this->storage[$offset])) {
            unset($this->storage[$offset]);
        }
    }
}