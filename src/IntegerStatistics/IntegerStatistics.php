<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.17.
 * Time: 21:18
 */

namespace Kata\IntegerStatistics;

class IntegerStatistics
{
    protected $array;

    public function __construct($array)
    {
        $this->array = $array;
    }

    public function getMinimum()
    {
        return min($this->array);
    }

    public function getMaximum()
    {
        return max($this->array);
    }

    public function getNumberOfElements()
    {
        return count($this->array);
    }

    public function getAverageValue()
    {
        return  array_sum($this->array) / $this->getNumberOfElements();
    }
} 