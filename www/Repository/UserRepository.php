<?php
/**
 * Created by PhpStorm.
 * User: zhenchao
 * Date: 23/04/2019
 * Time: 12:16
 */

class UserRepository{

    const  TABLE_NAME = "user";
    private $connection;

    public function __construct()
    {
        $this->connection = new BaseSQL(self::TABLE_NAME);
    }
}