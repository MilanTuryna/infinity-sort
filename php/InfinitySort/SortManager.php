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
     */
    public function __construct(array $rows) {
        $this->rows = $rows;

        $this->sort();
    }

    /**
     * @param ...$params
     */
    private function debug(... $params): void {
        echo json_encode([...$params]) . "\n";
    }

    // TODO: Change variable names, because it's so confusing

    /**
     * @return void
     */
    private function sort(): void {
        $levels1 = array_filter($this->rows, fn(sortObject $obj) => $obj->parent_id == 0);
        foreach ($levels1 as $firstLevel) {
            $firstLevel->level = 0;
            $childrenOf1 = array_filter($this->rows, fn(sortObject $obj) => $obj->parent_id === $firstLevel->id);
            $newEntry = sortObject::init()->createFrom($firstLevel);
            foreach ($childrenOf1 as $key => $child1) {
                $childrenOf1[$key]->level = 1; $child1->level = 1;
                $calculateInfinityLevel = function ($level, $otherLevels, &$superior, $k) use (&$calculateInfinityLevel) {
                    foreach ($otherLevels as $objKey => $obj) {
                        $obj->level = $level;
                        $this->debug($superior, $obj, $k);
                        $superior[$k]->children[] = $obj;
                        $nextLevel = $level + 1;
                        $filter = fn(sortObject $e) => $e->parent_id === $obj->id;
                        // used instead => foreach because php it's weird and when i use it, it will change original value into ass. array
                        $childrenKey = array_search($obj, $superior[$k]->children);
                        $calculateInfinityLevel($nextLevel, array_filter($this->rows, $filter),
                            $superior[$k]->children,
                            $childrenKey);
                    }
                };
                $filter = fn(sortObject $obj) => $obj->parent_id === $child1->id;
                $calculateInfinityLevel(2, array_filter($this->rows, $filter), $childrenOf1, $key);
            }
            $newEntry->children = array_values($childrenOf1);
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