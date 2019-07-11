<?php

declare(strict_types=1);

namespace Models;

use Core\BaseSQL;

// ImplementuserInterface
class restaurant extends BaseSQL
{

    public $id = null;
    public $name;
    public $description;
    public $id_category;
    public $template;
    public $id_fonts;
    public $text;
    public $image;
    public $id_user;
    public $button;
    public $status=1;

    public function __construct(){
        parent::__construct();
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
    public function getText():string
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     */
    public function setText($text):void
    {
        $this->text = $text;
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
    public function getButton():string
    {
        return $this->button;
    }

    /**
     * @param mixed $button
     */
    public function setButton($button):void
    {
        $this->button = $button;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getIdFonts():int
    {
        return $this->id_fonts;
    }

    /**
     * @param mixed $id_fonts
     */
    public function setIdFonts($id_fonts):void
    {
        $this->id_fonts = $id_fonts;
    }

    /**
     * @return mixed
     */
    public function getIdTemplate():int
    {
        return $this->template;
    }

    /**
     * @param mixed $id_template
     */
    public function setIdTemplate($id_template):void
    {
        $this->template = $id_template;
    }

    /**
     * @return mixed
     */
    public function getIdCategory():int
    {
        return $this->id_category;
    }

    /**
     * @param mixed $id_category
     */
    public function setIdCategory($id_category):void
    {
        $this->id_category = $id_category;
    }

    /**
     * @return mixed
     */
    public function getDescription():string
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description):void
    {
        $this->description = $description;
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

}




