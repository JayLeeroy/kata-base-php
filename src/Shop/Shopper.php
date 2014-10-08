<?php

namespace Kata\Shop;

class Shopper
{
    /**
     * The shopping cart.
     *
     * @var array
     */
    protected $items = array();

    /**
     * Return the shopping cart items.
     *
     * @return array   The shopping cart items.
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Add item to the shopping cart.
     *
     * @param string $item   The item.
     *
     * @return void
     */
    public function addItem($item)
    {
        if (!empty($item))
        {
            $this->items[] = $item;
        }
    }

    /**
     * Remove item to the shopping cart.
     *
     * @param string $item   The item.
     *
     * @return void
     */
    public function removeItem($item)
    {
        $index = array_search($item, $this->items);

        if ($index !== false)
        {
           unset($this->items[$index]);
        }
    }
}