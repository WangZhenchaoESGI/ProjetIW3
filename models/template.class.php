<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class template extends BaseSQL
{

    public $id = null;
    public $name;
    public $path;

    /**
     * @return null
     */
    public function getId():int
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id):void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName():string
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name):void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPath():string
    {
        return $this->path;
    }

    /**
     * @param mixed $path
     */
    public function setPath($path):void
    {
        $this->path = $path;
    }

}