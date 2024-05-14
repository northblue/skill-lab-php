<?php
/*
 *  For leetcode https://leetcode.com/problems/lru-cache/
 *  this solution is using native PHP array
 */


class LRUCache {
    private int $capacity;
    private array $map;
    private array $head;
    private array $tail;
    function __construct($capacity)
    {
        $this->capacity = $capacity;
        $this->map = [];
        $this->head = ['prev' => null, 'next' => null];
        $this->tail = ['prev' => null, 'next' => null];
        $this->head['next'] = &$this->tail;
        $this->tail['prev'] = &$this->head;
    }

    function get($key): int
    {
        if (!isset($this->map[$key])) {
            return -1;
        } else {
            $node = $this->map[$key];
            $this->removeNode($node);
            $this->addNode($node);
            return $node['value'];
        }
    }
    function put($key, $value): void
    {

        if (isset($this->map[$key])) {
            $node = $this->map[$key];
            $node['value'] = $value;
            $this->removeNode($node);
        } else {
            if(count($this->map) >= $this->capacity) {
                $firstNode = $this->head['next'];
                $this->removeNode($firstNode);
            }
            $node = ['key'=>$key, 'value' => $value];
        }
        $this->addNode($node);
    }
    function addNode($node): void
    {
        $prev = &$this->tail['prev'];
        $node['prev'] = &$prev;
        $node['next'] = &$this->tail;
        $prev['next'] = &$node;
        $this->tail['prev'] = &$node;
        $this->map[$node['key']] = &$node;
    }
    function removeNode($node): void
    {
        $prev = &$node['prev'];
        $next = &$node['next'];
        $prev['next'] = &$next;
        $next['prev'] = &$prev;
        unset($this->map[$node['key']]);

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
