<?php
namespace Kata\VelocityChecker;

class LoginData
{
    protected $loginName;
    protected $ipCountry;
    protected $loginIp;

    public function __construct($loginName, $ipCountry, $loginIp)
    {
        $this->loginName = $loginName;
        $this->ipCountry  = $ipCountry;
        $this->loginIp   = $loginIp;
    }

    public function getLoginName()
    {
        return $this->loginName;
    }

    public function getIpCountry()
    {
        return $this->ipCountry;
    }

    public function getLoginIp()
    {
        return $this->loginIp;
    }
}