<?php

/**
 * Contains the prime related functions.
 */

namespace Kata\Shop;

class Cashier
{
    /**@var Shopper   The Shopper instance. */
    protected $shopper;

    /**@var Shop   The Shop instance. */
    protected $shop;

    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    public function setShopper(Shopper $shopper)
    {
        $this->shopper = $shopper;
    }

    public function calculatePrice()
    {
        $shoppingCart       = $this->shopper->getItems();
        $items              = $this->shop->getItemData();
        $itemCounterPerType = array();
        $bill               = 0;

        foreach ($shoppingCart as $shoppingCartItem)
        {
            if (!isset($items[$shoppingCartItem]))
            {
                throw new \InvalidArgumentException(json_encode($items));
            }

            $itemCounterPerType[$shoppingCartItem] = isset($itemCounterPerType[$shoppingCartItem])
                ? $itemCounterPerType[$shoppingCartItem] + 1
                : 1
            ;

            if ($this->isDiscountedItem($items[$shoppingCartItem], $itemCounterPerType[$shoppingCartItem]))
            {
                $bill += $items[$shoppingCartItem][Shop::FIELD_PRICE] - $items[$shoppingCartItem][Shop::FIELD_OFFER_DISCOUNT];
            }
            else
            {
                $bill += $items[$shoppingCartItem][Shop::FIELD_PRICE];
            }
        }

        return $bill;
    }

    protected  function isDiscountedItem($itemData, $itemCount)
    {
        return (
            $itemData[Shop::FIELD_OFFER_MINIMUM_AMOUNT] <= $itemCount
            && $itemData[Shop::FIELD_OFFER_INTERVAL] > 0
            && ($itemCount % $itemData[Shop::FIELD_OFFER_INTERVAL]) === 0
        );
    }
}