<?php

namespace VO;

class DbPwd{
    private $pwd;

    public function __construct(string $pwd)
    {
        $this->pwd = $pwd;
    }

    public function getPwd(){
        return $this->pwd;
    }
}