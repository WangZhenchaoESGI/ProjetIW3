<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\dishes;
use Models\restaurant;
use Models\fonts;

class TemplateController extends BaseSQL {

    public function getAllRestaurant():array {

        $sql = " SELECT * FROM restaurant WHERE status=1;";
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function defaultAction(): void {

        if (isset($_GET['id'])){
            $design = new restaurant();
            $a = $design->getOneBy(['id'=>$_GET['id'],"status"=>1],false);

            if (empty($a)){

                $a=$this->getAllRestaurant();

                $v = new View("templateCarte", "front");
                $v->assign("resto",$a);
            }else{
                //dishes
                $d = $this->getAllDishes($_GET['id']);

                $fonts = new fonts();
                $f = $fonts->getOneBy(['id'=>$a['id_fonts']],false);

                $resto['restaurant'] = $a;
                $resto['dishes'] = $d;
                $resto['fonts'] = $f;

                switch ($a['template']){
                    case 1:
                        $v = new View("template", "template1");
                        break;
                    case 2:
                        $v = new View("template", "template2");
                        break;
                    default:
                        $v = new View("template", "template1");
                        break;

                }

                $v->assign("resto",$resto);
            }

        }else{

            $a=$this->getAllRestaurant();

            $v = new View("templateCarte", "front");
            $v->assign("resto",$a);
        }

    }

    public function getAllComments($id): array {

        $sql = " SELECT comment.*,Users.firstname,Users.email FROM comment,Users where Users.id=comment.id_user AND comment.id_plat=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function getAllDishes($id): array {

        $sql = " SELECT * FROM dishes where status=1 AND id_restaurant=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function platAction(): void {

        if (isset($_GET['id'])){

            $dishes = new dishes();
            $d = $dishes->getOneBy(["id"=>$_GET['id']],false);

            $design = new restaurant();
            $a = $design->getOneBy(['id'=>$d['id_restaurant']],false);

            // Véfirier si le restaurant est fermé par admin ?
            if ($a['status']==0){
                header("Location: /template");
            }

            $fonts = new fonts();
            $f = $fonts->getOneBy(['id'=>$a['id_fonts']],false);

            $c = $this->getAllComments($_GET['id']);

            $resto['restaurant'] = $a;
            $resto['dishes'] = $d;
            $resto['fonts'] = $f;
            $resto['comments'] = $c;

            $resto['title_plat'] = true;

            if ($d['status']==1){
                switch ($a['template']){
                    case 1:
                        $v = new View("plat", "template1");
                        break;
                    case 2:
                        $v = new View("plat", "template2");
                        break;
                    default:
                        $v = new View("plat", "template1");
                        break;
                }

                $v->assign("resto",$resto);
            }else{
                $_SESSION['error'] = "On n'a pas trouvé ce plat chez nous!";
                header("Location: /template?id=".$a['id']);
            }

        }else{
            $design = new restaurant();
            $a=$design->getAll();

            $v = new View("templateCarte", "front");
            $v->assign("resto",$a);
        }

    }

}