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
     * @param array $rows
     * @param bool $useAssociativeID
     */
    public function __construct(array $rows, bool $useAssociativeID = false) {
        $this->rows = $rows;

        $this->sort($useAssociativeID);
    }

    // TODO: Change variable names, because it's so confusing

    /**
     * @param bool $useAssociativeID
     * @return void
     */
    private function sort(bool $useAssociativeID = false): void {
        $levels1 = array_filter($this->rows, fn(sortObject $obj) => $obj->parent_id == 0);
        foreach ($levels1 as $firstLevel) {
            $firstLevel->level = 0;
            $childrenOf1 = array_filter($this->rows, fn(sortObject $obj) => $obj->parent_id === $firstLevel->id);
            $newEntry = sortObject::init()->createFrom($firstLevel);
            foreach ($childrenOf1 as $key => $child1) {
                $childrenOf1[$key]->level = 1; $child1->level = 1;
                $calculateInfinityLevel = function ($level, $otherLevels) use (&$calculateInfinityLevel, &$childrenOf1, $child1, $key) {
                    foreach ($otherLevels as $obj) {
                        $obj->level = $level;
                        $childrenOf1[$key]->children[] = $obj;
                        $nextLevel = $level + 1;
                        $filter = fn(sortObject $obj) => $obj->level === $nextLevel && $obj->parent_id === $obj->id;
                        $calculateInfinityLevel($nextLevel, array_filter($this->rows, $filter));
                    }
                };
                $filter = fn(sortObject $obj) => $obj->level === 2 && $obj->parent_id === $child1->id;
                $calculateInfinityLevel(2, array_filter($this->rows, $filter));
            }
            $newEntry->children = $useAssociativeID ? $childrenOf1 : array_values($childrenOf1);
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