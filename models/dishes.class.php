<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class dishes extends BaseSQL
{

    //id	name	contenu	image	price	id_restaurant	date_inserted
    public $id = null;
    public $name;
    public $contenu;
    public $image;
    public $price;
    public $status;
    public $id_restaurant;
    public $date_inserted;

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
    public function getContenu():string
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu):void
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getImage():string
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image):void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getPrice():float
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price):void
    {
        $this->price = $price;
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
    public function getDateInserted():string
    {
        return $this->date_inserted;
    }

    /**
     * @param mixed $date_inserted
     */
    public function setDateInserted($date_inserted):void
    {
        $this->date_inserted = $date_inserted;
    }

}