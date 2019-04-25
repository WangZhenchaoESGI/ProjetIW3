<?php

namespace VO;

class DbUser{
    private $user;

    public function __construct(string $user)
    {
        $this->user = $user;
    }

    public function getUser(){
        return $this->user;
    }
}