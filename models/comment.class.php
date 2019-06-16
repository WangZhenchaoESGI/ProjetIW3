<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;
use Core\Routing;

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
    public function getIdPlat()
    {
        return $this->id_plat;
    }

    /**
     * @param mixed $id_plat
     */
    public function setIdPlat($id_plat)
    {
        $this->id_plat = $id_plat;
    }

    /**
     * @return mixed
     */
    public function getStar()
    {
        return $this->star;
    }

    /**
     * @param mixed $star
     */
    public function setStar($star)
    {
        $this->star = $star;
    }

    /**
     * @return mixed
     */
    public function getIdUser()
    {
        return $this->id_user;
    }

    /**
     * @param mixed $id_user
     */
    public function setIdUser($id_user)
    {
        $this->id_user = $id_user;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    /**
     * @return mixed
     */
    public function getDateInserted()
    {
        return $this->date_inserted;
    }

    /**
     * @param mixed $date_inserted
     */
    public function setDateInserted($date_inserted)
    {
        $this->date_inserted = $date_inserted;
    }

}