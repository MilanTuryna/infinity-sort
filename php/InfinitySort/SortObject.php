<?php

namespace InfinitySort;

use Error;

/**
 * Class SortObject
 * @package InfinitySort
 */
class SortObject
{
    public string $name;
    public int $level = 0;
    public string $parent_id;
    public string $id;
    public array $children = [];

    /**
     * @param string $name
     * @param int $parent_id
     * @param int $id
     * @param array $children
     */
    public function __construct(
        string $name, int $parent_id, int $id, array $children = [])
    {
        $this->name = $name;
        $this->parent_id = $parent_id;
        $this->id = $id;
        $this->children = $children;
        $this->level = 0;
    }

    /**
     * Use only when you know what you are doing
     * @return SortObject
     */
    public static function init(): SortObject
    {
        return new SortObject("", 0, 0,  []);
    }

    /**
     * @param object $object
     * @return SortObject
     */
    public function createFrom(object $object): SortObject
    {
        $properties = get_object_vars($object);
        foreach (array_keys($properties) as $property) {
            if (!in_array($property, get_object_vars($this))) throw new Error();
            $this->{$property} = $object->{$property};
        }
        return $this;
    }
}