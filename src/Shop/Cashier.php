<?php

namespace Kata\Shop;

class Cashier
{
    /**@var Shopper   The Shopper instance. */
    protected $shopper;

    /**@var Shop   The Shop instance. */
    protected $shop;

    /**
     * Constructor.
     *
     * @param Shop $shop   The shop instance.
     */
    public function __construct(Shop $shop)
    {
        $this->shop = $shop;
    }

    /**
     * Sets the actual shopper.
     *
     * @param Shopper $shopper   The actual shopper instance.
     *
     * @return void
     */
    public function setShopper(Shopper $shopper)
    {
        $this->shopper = $shopper;
    }

    /**
     * Calculating the price by specified shop and the actual shopper.
     *
     * @return int
     * @throws \UnexpectedValueException
     */
    public function calculatePrice()
    {
        if (empty($this->shopper))
        {
            throw new \UnexpectedValueException('Invalid shopper instance');
        }

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

    /**
     * Returns the item is discounted or not.
     *
     * @param array $itemData   The specified item data.
     * @param int   $itemCount  The amount of the shopper shopped by the specified item.
     *
     * @return bool   The item is discounted or not.
     */
    protected  function isDiscountedItem($itemData, $itemCount)
    {
        return (
            $itemData[Shop::FIELD_OFFER_MINIMUM_AMOUNT] <= $itemCount
            && $itemData[Shop::FIELD_OFFER_INTERVAL] > 0
            && ($itemCount % $itemData[Shop::FIELD_OFFER_INTERVAL]) === 0
        );
    }
}