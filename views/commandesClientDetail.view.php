<style>
    h3{
        color: black;
    }
</style>
<div class="container" style="margin-top: 3rem">
    <div class="row">
        <div class="col-2">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="sidebar-inner slimscrollleft">
                        <style>
                            a{
                                color: black;
                            }
                            i{
                                color: black;
                            }
                        </style>
                        <div id="sidebar-menu">
                            <ul>
                                <li>
                                    <a href="/client" class="btn btn-danger">
                                        Detail
                                    </a>
                                </li>
                                <br>
                                <?php if (isset($total_quantity)): ?>
                                    <li>
                                        <a class="btn btn-warning" href="/panier">PANIER
                                            <i style="border: 1px solid red;border-radius: 10px;background-color: red;color: white;">
                                                <?php echo $total_quantity; ?>
                                            </i>
                                        </a>
                                    </li>
                                    <br>
                                <?php endif; ?>
                                <li>
                                    <a href="/commandes_client" class="btn btn-danger">
                                        Commandes
                                    </a>
                                </li>
                                <br>
                                <li>
                                    <a href="/deconnexion" class="btn btn-danger">
                                        Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end sidebarinner -->
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-10">
            <div class="card m-b-30">
                <div class="card-body">

                    <p>Commande : <?php echo $data['livraison']['id'] ?></p>
                    <p>Date : <?php echo $data['livraison']['date_inserted'] ?></p>
                    <p>Nom : <?php echo $data['address']['name'] ?></p>
                    <p>Address : <?php echo $data['address']['addresse'] ?></p>
                    <p>Ville : <?php echo $data['address']['city'] ?></p>
                    <p>Code postal : <?php echo $data['address']['postal'] ?></p>
                    <p>Tél. : <?php echo $data['address']['phone'] ?></p>

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Contenu</th>
                            <th>Image</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($data['dishes'] as $value): ?>
                            <tr>
                                <td><?php echo $value['name'] ?></td>
                                <td><?php echo $value['contenu'] ?></td>
                                <td><img class="img-feature img--wrap" width="150px" src="../public/upload/<?php echo $value['image']; ?>"></td>
                                <td><?php echo $value['price'] ?>€</td>
                                <td><?php echo $value['quantity'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>