<?php

namespace InfinitySort;

/**
 * Class SortManager
 * @package InfinitySort
 */
class SortManager
{
    private array $rows;
    /**
     * @var sortObject[] $sortedRows
     */
    public array $sortedRows;

    /**
     * @param ...$rows
     */
    public function __construct(...$rows) {
        $this->rows = $rows;

        $this->sort();
    }

    // TODO: Change variable names, because it's so confusing
    /**
     * @return void
     */
    private function sort(): void {
        $levels1 = array_filter($this->rows, fn(sortObject $obj) => $obj->level === 0);
        foreach ($levels1 as $firstLevel) {
            $childrenOf1 = array_filter($this->rows, fn(sortObject $obj) => $obj->parent_id === $firstLevel->id);
            $newEntry = sortObject::init()->createFrom($firstLevel);
            foreach ($childrenOf1 as $key => $child1) {
                $calculateInfinityLevel = function ($level, $otherLevels) use (&$calculateInfinityLevel, &$childrenOf1, $child1, $key) {
                    foreach ($otherLevels as $obj) {
                        $childrenOf1[$key]->children[] = $obj;
                        $nextLevel = $level + 1;
                        $filter = fn(sortObject $obj) => $obj->level === $nextLevel && $obj->parent_id === $obj->id;
                        $calculateInfinityLevel($nextLevel, array_filter($this->rows, $filter));
                    }
                };
                $filter = fn(sortObject $obj) => $obj->level === 2 && $obj->parent_id === $child1->id;
                $calculateInfinityLevel(2, array_filter($this->rows, $filter));
            }
            $newEntry->children = $childrenOf1;
            $this->sortedRows[] = $newEntry;
        }
    }

    /**
     * @return array
     */
    public function getHierarchy(): array {
        return $this->sortedRows;
    }
}