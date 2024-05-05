<?php
/*
 * Demo sample code for General Tree BFS.
 * It is going return the values of all the nodes from the binary tree.
 */
class TreeNode {
    public $val;
    public $children;

    function __construct($value) {
        $this->val = $value;
        $this->children = [];
    }

    function addChild($child) {
        $this->children[] = $child;
    }
}

function breadthFirstSearch($root) {
    if ($root === null) {
        return [];
    }

    $result = [];
    $queue = [$root];

    while (!empty($queue)) {
        $node = array_shift($queue); // Dequeue the first node
        $result[] = $node->val;

        // Enqueue all children of the current node
        foreach ($node->children as $child) {
            $queue[] = $child;
        }
    }

    return $result;
}


// Example usage:
$root = new TreeNode(1);
$child2 = new TreeNode(2);
$child3 = new TreeNode(3);
$child4 = new TreeNode(4);
$child5 = new TreeNode(5);
$child6 = new TreeNode(6);
$child7 = new TreeNode(7);
$root->addChild($child2);
$root->addChild($child3);
$child2->addChild($child7);
$child3->addChild($child4);
$child3->addChild($child5);
$child3->addChild($child6);

echo "BFS traversal result: " . implode(", ", breadthFirstSearch($root));
