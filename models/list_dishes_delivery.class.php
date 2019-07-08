<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;
use Core\Routing;

// ImplementuserInterface
class list_dishes_delivery extends BaseSQL
{

    public $id = null;
    public $id_dishes;
    public $code;

    /**
     * @return null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdDishes()
    {
        return $this->id_dishes;
    }

    /**
     * @param mixed $id_dishes
     */
    public function setIdDishes($id_dishes)
    {
        $this->id_dishes = $id_dishes;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

}