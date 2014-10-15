<?php
namespace Kata\VelocityChecker;

class Logger
{
    protected $log = array();

    public function logAttempt($key, $amount = 1)
    {
        if(!empty($amount))
        {
            $this->log[$key] = isset($this->log[$key]) ? ($this->log[$key] + $amount) : $amount;
        }
    }

    public function getAttempts()
    {
        return $this->log;
    }
}