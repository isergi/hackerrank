<?php

Class BinaryTreeNode {
    public $value = null;
    public $left = null;
    public $right = null;

    public function __construct($value) {
        $this->value = $value;
    }
}

Class BinaryTree {
    private $_root = null;

    public function add($value) {
        $node = new BinaryTreeNode($value);
        $this->_insertNode($node, $this->_root);
    }

    public function getTree() {
        return $this->_root;
    }

    private function _insertNode(BinaryTreeNode $node, &$subtree = null) {
        if (is_null($subtree)) {
            $subtree = $node;
        } else {
            if ($node->value < $subtree->value) {
                $this->_insertNode($node, $subtree->left);
            } else if ($node->value > $subtree->value) {
                $this->_insertNode($node, $subtree->right);
            }
        }

        return $this;
    }
}

?>