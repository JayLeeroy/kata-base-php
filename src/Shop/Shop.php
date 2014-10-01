<?php

/**
 * Contains the prime related functions.
 */

namespace Kata\Shop;

class Shop
{
    const FIELD_NAME                 = 'name';

    const FIELD_PRICE                = 'price';

    const FIELD_OFFER_MINIMUM_AMOUNT = 'offerMinimumAmount';

    const FIELD_OFFER_INTERVAL       = 'offerInterval';

    const FIELD_OFFER_DISCOUNT       = 'offerDiscount';


    const ITEM_APPLE     = 'apple';

    const ITEM_LIGHT     = 'light';

    const ITEM_STAR_SHIP = 'starShip';

    protected $itemData = array(
        self::ITEM_APPLE => array(
            self::FIELD_PRICE                => 32,
            self::FIELD_OFFER_MINIMUM_AMOUNT => 6,
            self::FIELD_OFFER_INTERVAL       => 1,
            self::FIELD_OFFER_DISCOUNT       => 7,
        ),
        self::ITEM_LIGHT => array(
            self::FIELD_PRICE                => 15,
            self::FIELD_OFFER_MINIMUM_AMOUNT => 0,
            self::FIELD_OFFER_INTERVAL       => 0,
            self::FIELD_OFFER_DISCOUNT       => 0,
        ),
        self::ITEM_STAR_SHIP => array(
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