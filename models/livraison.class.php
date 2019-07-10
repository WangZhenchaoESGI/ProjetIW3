<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class livraison extends BaseSQL
{

    public $id = null;
    public $montant;
    public $id_method;
    public $id_restaurant;
    public $id_client;
    public $status;
    public $code;
    public $vue;

    /**
     * @return mixed
     */
    public function getVue()
    {
        return $this->vue;
    }

    /**
     * @param mixed $vue
     */
    public function setVue($vue)
    {
        $this->vue = $vue;
    }

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
    public function getMontant()
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getIdMethod()
    {
        return $this->id_method;
    }

    /**
     * @param mixed $id_method
     */
    public function setIdMethod($id_method)
    {
        $this->id_method = $id_method;
    }

    /**
     * @return mixed
     */
    public function getIdRestaurant()
    {
        return $this->id_restaurant;
    }

    /**
     * @param mixed $id_restaurant
     */
    public function setIdRestaurant($id_restaurant)
    {
        $this->id_restaurant = $id_restaurant;
    }

    /**
     * @return mixed
     */
    public function getIdClient()
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client)
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
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