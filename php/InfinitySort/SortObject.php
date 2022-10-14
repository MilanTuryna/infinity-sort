<?php

namespace InfinitySort;

use Error;

class SortObject
{
    public string $name;
    public int $level;
    public string $parent_id;
    public string $id;
    public array $children = [];

    /**
     * @param string $name
     * @param int $level
     * @param int $parent_id
     * @param int $id
     * @param array $children
     */
    public function __construct(
        string $name, int $level, int $parent_id, int $id, array $children = [])
    {
        $this->name = $name;
        $this->level = $level;
        $this->parent_id = $parent_id;
        $this->id = $id;
        $this->children = $children;
    }

    /**
     * Use only when you know what you are doing
     * @return SortObject
     */
    public static function init(): SortObject
    {
        return new SortObject("", 0, 0, 0, []);
    }

    /**
     * @param object $object
     * @return void
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