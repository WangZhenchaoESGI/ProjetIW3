<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Administration / User  <?php echo $user['firstname']; ?>  <?php echo $user['lastname']; ?></h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="row">
    <div class="col-12">
        <div class="card m-b-30">
            <div class="card-body">
                <h5>ID: <?php echo $user['id']; ?></h5>
                <h5>Nom: <?php echo $user['firstname']; ?></h5>
                <h5>Prénom: <?php echo $user['lastname']; ?></h5>
                <h5>Téléphone: <?php echo $user['phone']; ?></h5>
                <h5>Email: <?php echo $user['email']; ?></h5>
                <h5>Status:
                    <?php if ($user['status'] == 1): ?>
                        <i class="fa fa-check" style="color: #50E3C2;font-size: 2rem;"></i>
                    <?php else: ?>
                        <i class="mdi mdi-close-circle-outline" style="color: red;font-size: 2rem;"></i>
                    <?php endif; ?>
                </h5>
                <h5>Role: <?php
                    switch ($user['role']){
                        case 1:
                            echo "Client";
                            break;
                        case 2:
                            echo "Pro";
                            break;
                        case 3:
                            echo "Admin";
                            break;
                    }
                    ?></h5>
                <h5>Date: <?php echo $user['date_inserted']; ?></h5>

                <form method="post" action="/roleUser?id=<?php echo $user['id']; ?>" class="col-md-6">
                    <div class="form-group row">
                        <h5>Modifiez le role</h5>
                        <div class="col-sm-6">
                            <select class="form-control" name="role">
                                <option value="1">Client</option>
                                <option value="2">Pro</option>
                                <option value="3">Admin</option>
                            </select>
                        </div>
                        <button class="btn btn-danger">Validez</button>
                    </div>

                </form>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->