<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Administration / Users</h4>
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
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Role</th>
                        <th>Date</th>
                        <th>Détail</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($users as $key => $value):?>
                        <tr id="<?php echo $value['id']; ?>">
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['firstname']; ?></td>
                            <td><?php echo $value['lastname']; ?></td>
                            <td><?php echo $value['phone']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td id="enable<?php echo $value['id']; ?>" onclick="enableUser(<?php echo $value['id']; ?>,'<?php echo $value['email']; ?>')" style="text-align: center">
                                <?php if ($value['status'] == 1): ?>
                                    <i class="fa fa-check" style="color: #50E3C2;font-size: 2rem;"></i>
                                <?php else: ?>
                                    <i class="mdi mdi-close-circle-outline" style="color: red;font-size: 2rem;"></i>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                switch ($value['role']){
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
                                ?>
                            </td>
                            <td><?php echo $value['date_inserted']; ?></td>

                            <td><a href="/userDetail?id=<?php echo $value['id']; ?>" class="btn btn-primary"><i class="fa fa-list"></i>&nbsp;&nbsp; Modifiez le role</a>&nbsp;&nbsp;<a class="btn btn-danger" onclick="deleteUser(<?php echo $value['id']; ?>,'<?php echo $value['firstname']." ".$value['lastname']; ?>')">Supprimez</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>

    function deleteUser(id,name) {
        var r=confirm("Vous voulez vraiment supprimer ID: "+id+" "+name+" ?");

        if (r==true)
        {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function(){
                if(request.readyState == 4){
                    var container = document.getElementById(id);
                    container.innerHTML="";
                }
            };

            request.open("POST", "/deleteUser");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

    function enableUser(id,name) {
        var r=confirm("Vous voulez vraiment changer le status ID: "+id+" "+name+" ?");

        if (r==true)
        {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function(){
                if(request.readyState == 4){
                    var container = document.getElementById("enable"+id);
                    if (request.response==1){
                        container.innerHTML="<i class='fa fa-check' STYLE='color: #50E3C2;font-size: 2rem;'></i>";
                    }else{
                        container.innerHTML="<i class=\"mdi mdi-close-circle-outline\" STYLE='color: red;font-size: 2rem;'></i>";
                    }

                }
            };

            request.open("POST", "/enableUser");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

</script>
