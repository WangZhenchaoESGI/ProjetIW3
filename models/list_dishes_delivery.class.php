<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class list_dishes_delivery extends BaseSQL
{

    public $id = null;
    public $id_dishes;
    public $quantity;
    public $code;

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
    public function getIdDishes():int
    {
        return $this->id_dishes;
    }

    /**
     * @param mixed $id_dishes
     */
    public function setIdDishes($id_dishes):void
    {
        $this->id_dishes = $id_dishes;
    }

    /**
     * @return mixed
     */
    public function getQuantity():int
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     */
    public function setQuantity($quantity):void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return mixed
     */
    public function getCode():string
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code):void
    {
        $this->code = $code;
    }

}