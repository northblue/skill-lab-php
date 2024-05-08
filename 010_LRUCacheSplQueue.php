<?php
/*
 *  For leetcode https://leetcode.com/problems/lru-cache/
 *  this solution is using PHP Spl queue
 */
class LRUCache {
    private int $capacity;
    private SplQueue $cache;
    private array $map;

    function __construct($capacity) {
        $this->capacity = $capacity;
        $this->cache = new SplQueue();
        $this->map = [];
    }

    function get($key) {
        if(!isset($this->map[$key])) {
            return -1;
        } else {
            $value = $this->map[$key];
            $this->updateCache($key, $value);
            return $value;
        }
    }

    function put($key, $value) {
        if(isset($this->map[$key])){
            $this->updateCache($key, $value);
        } else {
            if($this->cache->count() >= $this->capacity){
                $this->removeCache();
            }
            $this->addCache($key, $value);
        }
    }

    function updateCache($key, $value): void
    {
        $tempCache = new SplQueue();
        while($this->cache->count()) {
            $currentKey = $this->cache->dequeue();
            if($currentKey !== $key) {
                $tempCache->enqueue($currentKey);
            }
        }
        $this->cache = $tempCache;
        $this->cache->enqueue($key);
        $this->map[$key] = $value;
    }

    function removeCache(): void
    {
        $key = $this->cache->dequeue();
        unset($this->map[$key]);
    }

    function addCache($key, $value): void
    {
        $this->cache->enqueue($key);
        $this->map[$key] = $value;
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
