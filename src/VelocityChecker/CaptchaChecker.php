<?php
namespace Kata\VelocityChecker;

class CaptchaChecker
{
    const FAILED_USER_LIMIT = 3;

    const FAILED_IP_LIMIT = 3;

    const FAILED_IP_RANGE_LIMIT = 500;

    const FAILED_IP_COUNTRY_LIMIT = 1000;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * @var UserData
     */
    protected $userData;

    /**
     * @var LoginData
     */
    protected $loginData;

    public function  __construct(Logger $logger, UserData $userData, LoginData $loginData)
    {
        $this->logger    = $logger;
        $this->userData  = $userData;
        $this->loginData = $loginData;
    }

    public function isCaptchaNeeded($isHaveFailedLogin)
    {
        if ($isHaveFailedLogin)
        {
            if ($this->userData->getIpCountry() !== $this->loginData->getIpCountry())
            {
                $this->logger->logAttempt($this->loginData->getLoginIp(), self::FAILED_IP_LIMIT);

                return true;
            }

            $loggerData = $this->logger->getAttempts();
            $regexp     = '/\.([0-9]{1,3}$)/';
            $ipRange    = preg_replace($regexp, 'X', $this->loginData->getLoginIp());

            if (@$loggerData[$this->loginData->getLoginIp()] >= self::FAILED_IP_LIMIT)
            {
                $this->logger->logAttempt($this->loginData->getLoginIp());
            }
            else
            {
                $this->logger->logAttempt($this->loginData->getLoginIp());
                $this->logger->logAttempt($this->loginData->getIpCountry());
                $this->logger->logAttempt($this->loginData->getLoginName());
                $this->logger->logAttempt($ipRange);
            }

            $loggerData = $this->logger->getAttempts();
            $a =  @$loggerData[$this->loginData->getLoginIp()] >= self::FAILED_IP_LIMIT
                || @$loggerData[$this->loginData->getLoginName()] >= self::FAILED_USER_LIMIT
                || @$loggerData[$this->loginData->getIpCountry()] >= self::FAILED_IP_COUNTRY_LIMIT
                || @$loggerData[$ipRange] >= self::FAILED_IP_RANGE_LIMIT
                ;

            echo 'ezlett' . json_encode($loggerData);

            return $a;
        }

        return false;
    }
}