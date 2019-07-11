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
    public function getVue():int
    {
        return $this->vue;
    }

    /**
     * @param mixed $vue
     */
    public function setVue($vue):void
    {
        $this->vue = $vue;
    }

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
    public function getMontant():float
    {
        return $this->montant;
    }

    /**
     * @param mixed $montant
     */
    public function setMontant($montant):void
    {
        $this->montant = $montant;
    }

    /**
     * @return mixed
     */
    public function getIdMethod():int
    {
        return $this->id_method;
    }

    /**
     * @param mixed $id_method
     */
    public function setIdMethod($id_method):void
    {
        $this->id_method = $id_method;
    }

    /**
     * @return mixed
     */
    public function getIdRestaurant():int
    {
        return $this->id_restaurant;
    }

    /**
     * @param mixed $id_restaurant
     */
    public function setIdRestaurant($id_restaurant):void
    {
        $this->id_restaurant = $id_restaurant;
    }

    /**
     * @return mixed
     */
    public function getIdClient():int
    {
        return $this->id_client;
    }

    /**
     * @param mixed $id_client
     */
    public function setIdClient($id_client):void
    {
        $this->id_client = $id_client;
    }

    /**
     * @return mixed
     */
    public function getStatus():int
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status):void
    {
        $this->status = $status;
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