<?php

declare(strict_types=1);

namespace Controller;
use Core\BaseSQL;
use Core\View;
use Models\comment;
use Models\dishes;
use Models\template;
use Models\Users;
use Models\restaurant;
use Models\livraison;

class SuperAdminController extends BaseSQL{
    public function defaultAction(){
        $v = new View("dashboard", "back");
        $v->assign("pseudo","prof");
    }

    /*
     *  recuperer tous les infos des utilisateurs
     */
    public function usersAction():void{
        if ($this->isConnected()) {
            $users = new Users();
            $users = $users->getAll();
            $v = new View("users", "admin");
            $v->assign("users",$users);
        }else{
            header("Location: /connexion");
        }
    }

    /*
     *  afficher la détail du user selon son id
     */
    public function userDetailAction():void{
        if ($this->isConnected()) {
            if (!isset($_GET['id'])){
                header("Location: /users");
            }
            $users = new Users();
            $user = $users->getOneBy(['id'=>$_GET['id']],false);
            $v = new View("userDetail", "admin");
            $v->assign("user",$user);
        }else{
            header("Location: /connexion");
        }
    }

    /*
     * enable un user selon son id
     */
    public function enableUserAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $user = new Users();
                $d = $user->getOneBy(["id"=>$_POST['id']]);

                if ($d['status']==1){
                    $this->pdo->query("UPDATE Users SET status=0 WHERE id=".$_POST['id']);
                    echo 0;
                }else{
                    $this->pdo->query("UPDATE Users SET status=1 WHERE id=".$_POST['id']);
                    echo 1;
                }
            }
        }
    }

    /*
     * changer le role du user selon son id
     */
    public function roleUserAction(): void {

        if ( $this->isConnected() ){
            if (isset($_GET['id'])){
                $user = new Users();
                $d = $user->getOneBy(["id"=>$_POST['id']]);

                $this->pdo->query("UPDATE Users SET role=".$_POST['role']." WHERE id=".$_GET['id']);
                header("Location: /userDetail?id=".$_GET['id']);
                exit();
            }
            header("Location: /users");
            exit();

        }else{
            header("Location: /connexion");
            exit();

        }
    }

    /*
     * supprimer un user selon son id
     */
    public function deleteUserAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $user = new Users();
                $user->delete(["id"=>$_POST['id']]);
            }
        }
    }

    /*
     * supprimer une commentaires selon son id
     */
    public function deleteCommentairesAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $comment = new comment();
                $comment->delete(["id"=>$_POST['id']]);
            }
        }
    }

    /*
     * afficher toutes les infos des restaurants
     */
    public function restaurantsAction():void{
        if ($this->isConnected()) {

            $sql = "SELECT restaurant.id as restaurantID,restaurant.name as restaurantName,restaurant.status as restaurantStatus,category.name as category,Users.* FROM restaurant,category,Users WHERE restaurant.id_category = category.id AND restaurant.id_user = Users.id";
            $query = $this->pdo->query($sql);
            $data = $query->fetchAll();

            $v = new View("restaurant", "admin");
            $v->assign("data",$data);

        }else{
            header("Location: /connexion");
        }
    }

    public function enableRestaurantAction(): void {

        if ( $this->isConnected() ){
            if (isset($_POST['id'])){
                $restaurant = new restaurant();
                $d = $restaurant->getOneBy(["id"=>$_POST['id']]);

                if ($d['status']==1){
                    $this->pdo->query("UPDATE restaurant SET status=0 WHERE id=".$_POST['id']);
                    echo 0;
                }else{
                    $this->pdo->query("UPDATE restaurant SET status=1 WHERE id=".$_POST['id']);
                    echo 1;
                }
            }
        }
    }

    public function dashboardAction():void{

        if ($this->isConnected()) {

            // dashboard courbes
            $sql = "SELECT COUNT(id) as piece,DATE_FORMAT(date_inserted, '%Y-%m-%d') as month FROM livraison GROUP BY DATE_FORMAT(date_inserted, '%Y-%m-%d')";
            $query = $this->pdo->query($sql);
            $data['courbes'] = $query->fetchAll();

            // dashboard la somme des plats du restaurant
            $sql = "SELECT COUNT(id) as total FROM dishes";
            $query = $this->pdo->query($sql);
            $total = $query->fetch();
            $data['total_plat'] = $total['total'];

            // la revenu du jour du restaurant
            $sql = "SELECT COUNT(id) as total, sum(montant) as montant FROM livraison WHERE date_inserted >=  CURDATE()";
            $query = $this->pdo->query($sql);
            $total = $query->fetch();

            $data['total_livraison'] = $total['total'];
            $data['total_montant'] = $total['montant'];

            // la total de revenu du restaurant
            $sql = "SELECT sum(montant) as montant FROM livraison";
            $query = $this->pdo->query($sql);
            $total = $query->fetch();

            $data['total'] = $total['montant'];

            // la statistique du jour
            $sql ="SELECT COUNT(livraison.id) as total, sum(livraison.montant) as montant, method.name FROM livraison,method WHERE livraison.id_method=method.id AND livraison.date_inserted >=CURDATE() GROUP BY livraison.id_method";
            $query = $this->pdo->query($sql);
            $s= $query->fetchAll();
            $data['statistique'] = $s;

            $v = new View("dashboard", "admin");
            $v->assign("data",$data);

        }else{
            header("Location: /connexion");
        }

    }

    public function getAllProduits($id): array {

        $sql = " SELECT * FROM dishes where id_restaurant=".$id;
        $query = $this->pdo->query($sql);

        return $query->fetchAll();

    }

    public function allProduitsAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }

        $sql = "SELECT dishes.*,restaurant.name as restaurant FROM dishes,restaurant WHERE dishes.id_restaurant = restaurant.id";
        $query = $this->pdo->query($sql);

        $dishes = $query->fetchAll();

        $v = new View("produitsAdmin", "admin");
        $v->assign("dishes",$dishes);

    }

    /*
     *  Générer un sitemap et afficher
     */
    public function sitemapAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
        }

        $template = new template();
        $t = $template->getAll();

        $plats = new dishes();
        $p = $plats->getAll();

        $date = date('Y-m-dTH:i:sP', time());
        $handle = fopen("sitemap.xml", "w");
        fwrite($handle,"<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                                <urlset
                                      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
                                      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
                                      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
                                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">
                                
                                <url>
                                  <loc>http://wantwant.eu/</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>1.00</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/template</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/contact</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/connexion</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/ajouter_un_utilisateur</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>");
        foreach ($t as $key => $value){
            fwrite($handle, "
                <url>
                  <loc>http://wantwant.eu/template?id=".$value['id']."</loc>
                  <lastmod>".$date."</lastmod>
                  <priority>0.64</priority>
                </url>
            ");
        }

        foreach ($p as $key => $value){
            fwrite($handle, "
                <url>
                  <loc>http://wantwant.eu/plat?id=".$value['id']."</loc>
                  <lastmod>".$date."</lastmod>
                  <priority>0.51</priority>
                </url>
            ");
        }

        fwrite($handle, "</urlset>");
        fclose($handle);

        $data['template'] = $t;
        $data['plat'] = $p;

        $v = new View("sitemap", "admin");
        $v->assign("data",$data);

    }

    public function allCommandesAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
            exit();
        }

        $sql = "SELECT livraison.*,address.name as name,address.phone as phone,restaurant.name as restaurant, restaurant.id as restaurantID FROM livraison,address,restaurant WHERE livraison.code=address.code AND livraison.id_restaurant = restaurant.id ORDER BY livraison.id DESC ";
        $query = $this->pdo->query($sql);
        $data = $query->fetchAll();
        $v = new View("commandesAdmin", "admin");
        $v->assign("commandes",$data);

    }

    public function allCommentairesAction(): void {

        if ($this->isConnected() == false){
            header("Location: /");
            exit();
        }

        $sql = "SELECT comment.*,restaurant.name as restaurant, dishes.id as dishesID, dishes.name as dishes,Users.email as email FROM comment,restaurant,dishes,Users WHERE comment.id_restaurant = restaurant.id AND comment.id_plat = dishes.id AND comment.id_user = Users.id";
        $query = $this->pdo->query($sql);
        $data = $query->fetchAll();
        $v = new View("commentaires", "admin");
        $v->assign("data",$data);

    }

    public function commandeDetailAction():void{
        if ($this->isConnected()) {
            if (isset($_GET['code'])){

                $livraison = new livraison();
                $livraison = $livraison->getOneBy(['code'=>$_GET['code']],false);

                $sql2 = "SELECT * FROM address WHERE code=:code";
                $sql3 = "SELECT list_dishes_delivery.*,dishes.* FROM list_dishes_delivery,dishes WHERE list_dishes_delivery.code=:code AND list_dishes_delivery.id_dishes = dishes.id";
                $query = $this->pdo->prepare($sql2);
                $query->execute(['code'=>$_GET['code']]);
                $address = $query->fetch();

                $query = $this->pdo->prepare($sql3);
                $query->execute(['code'=>$_GET['code']]);
                $dishes = $query->fetchAll();

                $restaurant = new restaurant();
                $restaurant = $restaurant->getOneBy(['id'=>$livraison['id_restaurant']],false);

                $data['restaurant'] = $restaurant;
                $data['livraison'] = $livraison;
                $data['address'] = $address;
                $data['dishes'] = $dishes;

                $v = new View("commandesDetail", "admin");
                $v->assign("data",$data);

            }else{
                header("Location: /commandes");
            }
        }else{
            header("Location: /connexion");
        }
    }

    public function isConnected(): bool {
        $user = new \Controller\UsersController();

        if ($user->isConnected() && ( $user->role()==3 ) ) return true;

        return false;
    }


}