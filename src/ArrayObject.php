<?php

namespace Mosaic\Common;

class ArrayObject extends \ArrayObject implements Arrayable
{
    /**
     * @return array
     */
    public function toArray()
    {
        return $this->getArrayCopy();
    }
}
