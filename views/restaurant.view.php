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
                        <th>ID</th>
                        <th>Restaurant</th>
                        <th>Catégorie</th>
                        <th>PRO</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($data as $key => $value):?>
                        <tr>
                            <td><?php echo $value['restaurantID']; ?></td>
                            <td><?php echo $value['restaurantName']; ?></td>
                            <td><?php echo $value['category']; ?></td>
                            <td><?php echo $value['firstname']." ".$value['lastname']; ?>€</td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['phone']; ?></td>
                            <td id="enable<?php echo $value['restaurantID']; ?>" onclick="enableRestaurant(<?php echo $value['restaurantID']; ?>,'<?php echo $value['restaurantName']; ?>')" style="text-align: center">
                                <?php if ($value['restaurantStatus'] == 1): ?>
                                    <i class="fa fa-check" style="color: #50E3C2;font-size: 2rem;"></i>
                                <?php else: ?>
                                    <i class="mdi mdi-close-circle-outline" style="color: red;font-size: 2rem;"></i>
                                <?php endif; ?>
                            </td>
                            <td><a target="_blank" href="/template?id=<?php echo $value['restaurantID']; ?>" class="btn btn-primary"><i class="mdi mdi-link"></i>&nbsp;&nbsp; Voir le site</a>&nbsp;&nbsp;<a class="btn btn-danger" onclick="deleteUser(<?php echo $value['id']; ?>,'<?php echo $value['firstname']." ".$value['lastname']; ?>')">Supprimez</a></td>
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

    function enableRestaurant(id,name) {
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

            request.open("POST", "/enableRestaurant");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

</script>
