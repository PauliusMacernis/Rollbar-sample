<?php

namespace Demo;

class Settings
{
    private $environment = 'development';
    private $rollbarAccessTokenJs = 'a0a1e4eb59084f04951064e852d56411';
    private $rollbarAccessTokenPhp = 'f499536c0e8e40e98e6fd3ce808a84b7';

    /**
     * @return string
     */
    public function getEnvironment()
    {
        return $this->environment;
    }

    /**
     * @return string
     */
    public function getRollbarAccessTokenJs()
    {
        return $this->rollbarAccessTokenJs;
    }

    /**
     * @return string
     */
    public function getRollbarAccessTokenPhp()
    {
        return $this->rollbarAccessTokenPhp;
    }
}