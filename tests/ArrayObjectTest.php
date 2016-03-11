<?php

namespace Mosaic\Common\Tests;

use Mosaic\Common\ArrayObject;

class ArrayObjectTest extends \PHPUnit_Framework_TestCase
{
    public function test_can_transform_object_to_array()
    {
        $array = [
            'element1',
            'element2'
        ];

        $this->assertEquals($array, (new ArrayObject($array))->toArray());
    }

    public function test_object_is_traversable()
    {
        $object = new ArrayObject([
            'element1'
        ]);

        foreach ($object as $element) {
            $this->assertEquals('element1', $element);
        }
    }

    public function test_object_has_array_access()
    {
        $object = new ArrayObject([
            'key' => 'element1'
        ]);

        $this->assertEquals('element1', $object['key']);
    }

    public function test_object_is_countable()
    {
        $object = new ArrayObject([
            'element1',
            'element2'
        ]);

        $this->assertEquals(2, $object->count());
    }

    public function test_object_is_serializable()
    {
        $object = new ArrayObject($array = [
            'element1',
            'element2'
        ]);

        $new        = new ArrayObject();
        $serialized = $object->serialize();

        $new->unserialize($serialized);

        $this->assertContains('element1', $serialized);
        $this->assertEquals($object, $new);
    }
}
