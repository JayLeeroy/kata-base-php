<?php
/**
 * Created by PhpStorm.
 * User: Jay
 * Date: 2014.09.17.
 * Time: 21:18
 */

namespace Kata\HundredDoors;

class HundredDoors
{
    protected $doors = array();

    protected $stepValue;

    public function __construct($maxDoors, $stepInitValue, $initValue)
    {
        if (!is_int($maxDoors) || $maxDoors < 1)
        {
            // TODO : Unique Expception
            throw new \InvalidArgumentException();
        }

        if (!is_int($stepInitValue) || $stepInitValue < 0)
        {
            // TODO : Unique Expception
            throw new \InvalidArgumentException();
        }

        if (!is_bool($initValue))
        {
            // TODO : Unique Expception
            throw new \InvalidArgumentException();
        }

        $this->doors     = array_fill(0, $maxDoors, $initValue);
        $this->stepValue = $stepInitValue;
    }

    public function getDoors()
    {
        return $this->doors;
    }

    public function doSequence()
    {
        $startIndex = $this->stepValue;
        $this->stepValue++;
        $doorCount  = count($this->doors);

        for ($i = $startIndex; $i < $doorCount; $i++)
        {
            if ($i % $this->stepValue === 0) {
                $this->doors[$i] = !$this->doors[$i];
            }
        }
    }

    public function getOpenedDoors()
    {
        $openedDoors = array();

        foreach ($this->doors as $key => $door)
        {
            if ($door)
            {
                $openedDoors[] = $key;
            }
        }

        return $openedDoors;
    }
}