<?php

/*
 * Demo sample code for Binary Tree BFS.
 * It is going return the values of all the nodes from the binary tree.
 */

class TreeNode
{
    public $val;
    public $left;
    public $right;

    function __construct($value)
    {
        $this->val = $value;
        $this->left = null;
        $this->right = null;
    }
}

function breadthFirstSearch($root)
{
    if ($root === null) {
        return [];
    }

    $result = [];
    $queue = [$root];

    while (!empty($queue)) {
        $node = array_shift($queue); // Dequeue the first node
        $result[] = $node->val;

        // Enqueue the left child if it exists
        if ($node->left !== null) {
            $queue[] = $node->left;
        }

        // Enqueue the right child if it exists
        if ($node->right !== null) {
            $queue[] = $node->right;
        }
    }

    return $result;
}

// Example usage:
$root = new TreeNode(1);
$root->left = new TreeNode(2);
$root->right = new TreeNode(3);
$root->left->left = new TreeNode(4);
$root->left->right = new TreeNode(5);

echo "BFS traversal result: " . implode(", ", breadthFirstSearch($root));
