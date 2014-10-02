<?php

/**
 * Contains the prime related functions.
 */

namespace Kata\Shop;

class Shopper
{
    protected $items = array();

    public function getItems()
    {
        return $this->items;
    }

    public function addItem($item)
    {
        $this->items[] = $item;
    }
}