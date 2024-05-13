<?php
/*
 *  For leetcode https://leetcode.com/problems/lru-cache/
 *  this solution is using Custom node object
 */

class Node {
    public ?int $value;
    public ?int $key;
    public ?Node $next;
    public ?Node $prev;

    function __construct(int $key = null, int $value = null) {
        $this->key = $key;
        $this->value = $value;
        $this->next = null;
        $this->prev = null;
    }
}
class LRUCache {
    private int $capacity;
    private array $map;
    private Node $head;
    private Node $tail;
    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->map = [];
        $this->head = new Node();
        $this->tail = new Node();
        $this->head->next = $this->tail;
        $this->tail->prev = $this->head;
    }
    /**
     * @param Integer $key
     * @return Integer
     */
    function get(int $key): int
    {
        if (!isset($this->map[$key])) {
            return -1;
        } else {
            $node = $this->map[$key];
            $this->removeNode($node);
            $this->addNode($node);
            return $node->value;
        }
    }
    /**
     * @param Integer $key
     * @param Integer $value
     * @return void
     */
    function put(int $key, int $value): void
    {
        if (isset($this->map[$key])) {
            $node = $this->map[$key];
            $node->value = $value;
            $this->removeNode($node);
            $this->addNode($node);
        } else {
            if (count($this->map) >= $this->capacity) {
                $firstNode = $this->head->next;
                $this->removeNode($firstNode);
                unset($this->map[$firstNode->key]);
            }
            $node = new Node($key, $value);
            $this->addNode($node);
            $this->map[$key] = $node;
        }
    }
    function removeNode(Node $node): void
    {
        $prev = $node->prev;
        $next = $node->next;
        $prev->next = $next;
        $next->prev = $prev;
    }
    function addNode(Node $node): void
    {
        $node->prev = $this->tail->prev;
        $node->next = $this->tail;
        $node->prev->next = $node;
        $node->next->prev = $node;

    }

}


// Create a new LRUCache with capacity 2
$lruCache = new LRUCache(2);

// Insert key-value pairs into the cache
$lruCache->put(1, 1);
$lruCache->put(2, 2);

// Access a key to move it to the front of the cache
echo $lruCache->get(1).PHP_EOL; // Output: 1

// Add a new key-value pair, which should evict the least recently used key (2)
$lruCache->put(3, 3);

// Access a key that was not evicted
echo $lruCache->get(2).PHP_EOL; // Output: -1

// Access the newly added key
echo $lruCache->get(3).PHP_EOL; // Output: 3
