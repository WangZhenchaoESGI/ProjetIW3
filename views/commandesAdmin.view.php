<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Administration / Commandes</h4>
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
                        <th></th>
                        <th>Commande ID</th>
                        <th>< ID > Restaurant</th>
                        <th>Nom</th>
                        <th>Téléphone</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Vue</th>
                        <th>Détail</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($commandes as $key => $value):?>
                        <tr>
                            <td></td>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo "<".$value['restaurantID']."> ".$value['restaurant']; ?></td>
                            <td><?php echo $value['name']; ?></td>
                            <td><?php echo $value['phone']; ?></td>
                            <td><?php echo $value['montant']; ?>€</td>
                            <td><?php echo $value['date_inserted']; ?></td>
                            <td>
                                <?php if ($value['vue'] == 1): ?>
                                    <i class="fa fa-check" style="color: #50E3C2;font-size: 2rem;"></i>
                                <?php else: ?>
                                    <i class="mdi mdi-clock-fast" style="color: red;font-size: 2rem;"></i>
                                <?php endif; ?>
                            </td>
                            <td><a href="/commandes_detail_admin?code=<?php echo $value['code']; ?>" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;&nbsp; Voir le détail</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->
