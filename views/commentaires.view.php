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
                        <th>User</th>
                        <th>Restaurant</th>
                        <th>Plat</th>
                        <th>Star</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php foreach ($data as $key => $value):?>
                        <tr id="<?php echo $value['id']; ?>">
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo $value['email']; ?></td>
                            <td><?php echo $value['restaurant']; ?></td>
                            <td><?php echo "<".$value['dishesID']."> ".$value['dishes']; ?></td>
                            <td><?php echo $value['star']; ?></td>
                            <td><?php echo $value['contenu']; ?></td>
                            <td><?php echo $value['date_inserted']; ?></td>

                            <td><a href="/plat?id=<?php echo $value['dishesID']; ?>" class="btn btn-primary"><i class="mdi mdi-link"></i>&nbsp;&nbsp; Voir</a>&nbsp;&nbsp;<a class="btn btn-danger" onclick="deleteCommentaires(<?php echo $value['id']; ?>)">Supprimez</a></td>
                        </tr>
                    <?php endforeach;?>
                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div> <!-- end row -->

<script>

    function deleteCommentaires(id) {
        var r=confirm("Vous voulez vraiment supprimer ID: "+id+" ?");

        if (r==true)
        {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function(){
                if(request.readyState == 4){
                    var container = document.getElementById(id);
                    container.innerHTML="";
                }
            };

            request.open("POST", "/deleteCommentaires");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

</script>
