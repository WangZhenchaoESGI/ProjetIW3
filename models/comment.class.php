<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class comment extends BaseSQL
{

    //id	id_restaurant	id_plat	star	id_user	contenu	date_inserted
    public $id = null;
    public $id_restaurant;
    public $id_plat;
    public $star;
    public $id_user;
    public $contenu;
    public $date_inserted;

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
    public function getIdPlat():int
    {
        return $this->id_plat;
    }

    /**
     * @param mixed $id_plat
     */
    public function setIdPlat($id_plat):void
    {
        $this->id_plat = $id_plat;
    }

    /**
     * @return mixed
     */
    public function getStar():int
    {
        return $this->star;
    }

    /**
     * @param mixed $star
     */
    public function setStar($star):void
    {
        $this->star = $star;
    }

    /**
     * @return mixed
     */
    public function getIdUser():int
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user):void
    {
        $this->id_user = $id_user;
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