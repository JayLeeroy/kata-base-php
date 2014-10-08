<?php

namespace Kata\Shop;

class Shop
{
    const FIELD_NAME                 = 'name';

    const FIELD_PRICE                = 'price';

    const FIELD_OFFER_MINIMUM_AMOUNT = 'offerMinimumAmount';

    const FIELD_OFFER_INTERVAL       = 'offerInterval';

    const FIELD_OFFER_DISCOUNT       = 'offerDiscount';

    protected $itemData = array(
        'apple' => array(
            self::FIELD_PRICE                => 32,
            self::FIELD_OFFER_MINIMUM_AMOUNT => 6,
            self::FIELD_OFFER_INTERVAL       => 1,
            self::FIELD_OFFER_DISCOUNT       => 7,
        ),
        'light' => array(
            self::FIELD_PRICE                => 15,
            self::FIELD_OFFER_MINIMUM_AMOUNT => 0,
            self::FIELD_OFFER_INTERVAL       => 0,
            self::FIELD_OFFER_DISCOUNT       => 0,
        ),
        'starShip' => array(
            self::FIELD_PRICE                => 999.99,
            self::FIELD_OFFER_MINIMUM_AMOUNT => 3,
            self::FIELD_OFFER_INTERVAL       => 3,
            self::FIELD_OFFER_DISCOUNT       => 999.99,
        ),
    );

    public function getItemData()
    {
        return $this->itemData;
    }
}