<?php


namespace Kata\Registration;

class User{
    protected $userName;
    
    protected $passwordHash;
    
    protected $plainPassword;
    
    public function __construct($userName, $plainPassword, $passwordHash)
    {
        $this->userName = $userName;
        $this->plainPassword = $plainPassword;
        $this->passwordHash = $passwordHash;
    }

    public function getUserName()
    {
        return $this->userName;
    }

    public function getPlainPassword()
    {
        return $this->plainPassword;
    }

    public function getPasswordHash()
    {
        return $this->passwordHash;
    }
}