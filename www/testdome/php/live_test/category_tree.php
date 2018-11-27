<?php

class CategoryTree
{
    private $categories = [];

    public function addCategory($category, $parent)
    {
        if (isset($this->categories[ $category ])) {
            throw new InvalidArgumentException('Category already exists');
        }

        if (!is_null($parent) && !isset($this->categories[ $parent ])) {
            throw new InvalidArgumentException('Parent category does not exist');
        }

        if (!is_null($parent)) {
            $this->categories[ $parent ][] = $category;
        }
        $this->categories[ $category ] = [];
    }
    
    public function getChildren($parent)
    {
        if (!isset($this->categories[ $parent ])) {
            throw new InvalidArgumentException('Parent category does not exist');
        }
        return $this->categories[ $parent ];
    }
}

$c = new CategoryTree;
$c->addCategory('A', null);
$c->addCategory('B', 'A');
$c->addCategory('C', 'A');
$c->addCategory('D', 'C');
echo implode(',', $c->getChildren('A'));
