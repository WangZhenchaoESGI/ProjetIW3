<section class="container">
    <br>
    <h2 class="font-16 m-b-15">Votre panier</h2>
    <br><br>
    <table class="table">
        <tbody>
        <tr>
            <th style="text-align:left;">ID</th>
            <th style="text-align:left;">Nom</th>
            <th style="text-align:right;">Quntité</th>
            <th style="text-align:right;">Unit Price</th>
            <th style="text-align:right;">Price</th>
            <th style="text-align:center;">Remove</th>
        </tr>
        <?php
        if(isset($_SESSION["cart_item"])){
            $total_quantity = 0;
            $total_price = 0;

            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                <tr id="panier<?php echo $item["id"]; ?>">
                    <td><?php echo $item["id"]; ?></td>
                    <td><?php echo $item["name"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="/panier_remove?id=<?php echo $item["id"]; ?>" style="color: red">X</a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
            }
            ?>

        <?php } ?>

        <tr>
            <td> </td>
            <td> </td>
            <td colspan="2" align="right">Total:<?php echo $total_quantity; ?></td>
            <td align="right"></td>
            <td align="right" colspan="2"><strong><?php echo number_format($total_price, 2); ?>€</strong></td>
            <td></td>
        </tr>
        </tbody>
    </table>
</section>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="">

                <h2 class="font-16 m-b-15">Information de la livraison</h2>
                <br>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Nom</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="nom" id="example-email-input" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Téléphone</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="tel" id="example-email-input" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Adresse</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="address" id="example-email-input" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Code Postal</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="cp" id="example-email-input" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="example-email-input" class="col-sm-2 col-form-label">Ville</label>
                    <div class="col-sm-10">
                        <input class="form-control" type="text" name="ville" id="example-email-input" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-md-3 my-1 control-label">Méthode de paiement</label>

                    <div class="col-md-9">
                        <?php foreach ($method as $key => $value):?>
                            <div class="form-check-inline my-1">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="customRadio<?php echo $value['id'] ?>" <?php echo $value['id']==4?"checked":""; ?> name="customRadio" value="<?php echo $value['id'] ?>" class="custom-control-input">
                                    <label class="custom-control-label" for="customRadio<?php echo $value['id'] ?>"><?php echo $value['name'] ?></label>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>

                </div> <!--end row-->
                <div class="form-group">
                    <div>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            Validez
                        </button>
                        <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                            Annulez
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

    function deleteComment(id) {
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

            request.open("POST", "/delete_comment");
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            request.send("id="+ id);
        }
    }

    function removeProduct(id) {
        var request = new XMLHttpRequest();
        request.onreadystatechange = function(){
            if(request.readyState == 4){
                var container = document.getElementById("panier"+id);
                container.innerHTML="";
            }
        };

        request.open("POST", "/commande_remove");
        request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        request.send("id="+ id);
    }

</script>