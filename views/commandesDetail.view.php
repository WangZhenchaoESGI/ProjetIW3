<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Administration / Détail de la commande <?php echo $data['livraison']['id'] ?></h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="col-12">
    <div class="card m-b-30">
        <div class="card-body">

            <p>Commande : <?php echo $data['livraison']['id'] ?></p>

            <?php if (isset($data['restaurant'])): ?>
                <p>Restaurant : <?php echo $data['restaurant']['name'] ?></p>
            <?php endif; ?>

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

        </div><!-- /.modal -->
    </div>
</div>
</div>