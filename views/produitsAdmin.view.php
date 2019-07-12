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
                    <h2 style="margin-top: -1px">Plats</h2>
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
                        <th>RESTAURANT</th>
                        <th>NOM</th>
                        <th>DESCRIPTION</th>
                        <th>TARIF</th>
                        <th>PHOTO</th>
                        <th>ENABLE</th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if (!empty($dishes) && $dishes!=NULL):?>

                        <?php foreach ($dishes as $key => $value):?>
                            <tr id="<?php echo $value['id']; ?>">
                                <td><?php echo $value['id']; ?></td>
                                <td><?php echo $value['restaurant']; ?></td>
                                <td><?php echo $value['name']; ?></td>
                                <td><?php echo $value['contenu']; ?></td>
                                <td><?php echo $value['price']; ?>€</td>
                                <td><img src="../public/upload/<?php echo $value['image']; ?>" width="100px"></td>
                                <td id="enable<?php echo $value['id']; ?>" onclick="enablePlat(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>')">
                                    <?php if ($value['status']==1): ?>
                                        <i class="fa fa-check" STYLE="color: #50E3C2;font-size: 2rem;"></i>
                                    <?php else: ?>
                                        <i class="mdi mdi-close-box" STYLE="color: red;font-size: 2rem;"></i>
                                    <?php endif; ?>
                                </td>
                                <td><a class="btn btn-primary" href="/plat?id=<?php echo $value['id']; ?>">Affichez</a>&nbsp;&nbsp;<a class="btn btn-danger" onclick="deletePlat(<?php echo $value['id']; ?>,'<?php echo $value['name']; ?>')">Supprimez</a></td>
                            </tr>
                        <?php endforeach;?>

                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>

    function deletePlat(id,name) {
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

            request.open("POST", "/delete_produit");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

    function enablePlat(id,name) {
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
                        container.innerHTML="<i class='mdi mdi-close-box' STYLE='color: red;font-size: 2rem;'></i>";
                    }

                }
            };

            request.open("POST", "/enable_produit");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

</script>
