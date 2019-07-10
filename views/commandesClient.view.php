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

                    <table id="datatable" class="table table-bordered">
                        <thead>
                        <tr>
                            <th>Commande</th>
                            <th>Date</th>
                            <th>État</th>
                            <th>Restaurant</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($commandes as $value): ?>
                        <tr>
                            <td><?php echo $value['id'] ?></td>
                            <td><?php echo $value['date_inserted'] ?></td>
                            <td><?php echo $value['status']==1?"Non payé":"Payé"; ?></td>
                            <td><?php echo $value['restaurant'] ?></td>
                            <td><?php echo $value['montant'] ?>€</td>
                            <td><a href="/commandes_client_detail?code=<?php echo $value['code']; ?>">Détail</a></td>
                        </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>