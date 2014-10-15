<?php
namespace Kata\VelocityChecker;

class UserData
{
    protected $loginName;
    protected $ipCountry;
    protected $registrationIp;

    public function __construct($loginName, $password, $ipCountry)
    {
        $this->loginName      = $loginName;
        $this->ipCountry      = $password;
        $this->registrationIp = $ipCountry;
    }

    public function getLoginName()
    {
        return $this->loginName;
    }

    public function getIpCountry()
    {
        return $this->ipCountry;
    }

    public function getRegistrationIp()
    {
        return $this->registrationIp;
    }
}