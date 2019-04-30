<?php

namespace VO;

class DbDriver{
    private $driver;

    public function __construct(string $driver)
    {
        $this->driver = $driver;
    }

    public function getDriver(){
        return $this->driver;
    }
}