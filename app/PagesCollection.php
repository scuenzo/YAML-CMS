<?php

namespace App;

use IteratorAggregate;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use RecursiveRegexIterator;
use RegexIterator;
use Traversable;

/**
 * PagesCollection offers convenience methods to query and get multiple pages
 * @package App
 */
class PagesCollection implements IteratorAggregate
{

    private $pages = [];

    /**
     * @param string $path
     * @param int $depth
     */
    public function __construct($path = null, $depth = null)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator(content_path . DIRECTORY_SEPARATOR . trim($path, '/')));
        if ($depth !== null) {
            $files->setMaxDepth($depth);
        }
        $files = new RegexIterator($files, '/^.+\.yaml$/i', RecursiveRegexIterator::GET_MATCH);
        foreach ($files as $path => $value) {
            $this->pages[] = new Page($path);
        }
    }

    /**
     * Permet de filtrer la collection afin d'obtenir les pages correspondantes au critère
     * @param string $key
     * @param string $value
     * @return $this
     */
    public function where($key, $value)
    {
        $this->pages = array_filter($this->pages, function ($page) use ($key, $value) {
            return $page->$key == $value;
        });
        return $this;
    }

    /**
     * Make this class iterable using ArrayIterator on pages
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->pages);
    }
}