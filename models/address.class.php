<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class address extends BaseSQL
{

    public $id = null;
    public $name;
    public $addresse;
    public $city;
    public $postal;
    public $phone;
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
    public function getAddresse():string
    {
        return $this->addresse;
    }

    /**
     * @param mixed $addresse
     */
    public function setAddresse($addresse):void
    {
        $this->addresse = $addresse;
    }

    /**
     * @return mixed
     */
    public function getCity():string
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city):void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getPostal():string
    {
        return $this->postal;
    }

    /**
     * @param mixed $postal
     */
    public function setPostal($postal):void
    {
        $this->postal = $postal;
    }

    /**
     * @return mixed
     */
    public function getPhone():string
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone):void
    {
        $this->phone = $phone;
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