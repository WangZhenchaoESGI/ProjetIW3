<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="btn-group float-right">
                <div class="row commandes" id="commandes-header">
                    <figure>
                        <a style="text-decoration: none;list-style: none" href="/add_produit">
                            <img src="../public/img/icones/icons8-plus-80.png" width="35px" style="margin-bottom: 10px"/>
                        </a>
                    </figure>
                    <h2 style="margin-top: -1px">PRODUITS</h2>
                </div>
            </div>
            <h4 class="page-title">Administration / Produits</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>NOM</th>
                        <th>DESCRIPTION</th>
                        <th>TARIF</th>
                        <th>PHOTO</th>
                        <th>ENABLE</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($dishes as $key => $value):?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['contenu']; ?></td>
                            <td><?php echo $value['price']; ?>€</td>
                            <td><img src="../public/upload/<?php echo $value['image']; ?>" width="100px"></td>
                            <td><i class="fa fa-check" STYLE="color: #50E3C2;"></i></td>
                            <td><a class="btn btn-warning" href="/update_produit?id=<?php echo $value['id']; ?>">Modifez</a>&nbsp;&nbsp;<a class="btn btn-danger" href="/delete_produit?id=<?php echo $value['id']; ?>">Supprimez</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
