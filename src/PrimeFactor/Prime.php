<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.11.
 * Time: 18:44
 */

namespace Kata\PrimeFactor;

class  Prime {
    public function getPrimeFactor($number)
    {
        if ($number < 2)
        {
            return array($number);
        }

        $divider = 2;
        $factors = [];

        while ($number !== 1)
        {
            if ($number % $divider === 0)
            {
                $factors[] = $divider;
                $number   /= $divider;
            }
            else
            {
                $divider++;
            }
        }

        return $factors;
    }
}