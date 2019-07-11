<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class fonts extends BaseSQL
{

    public $id = null;
    public $name;
    public $content;

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
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content):void
    {
        $this->content = $content;
    }

}