<link href="../public/admin/plugins/animate/animate.css" rel="stylesheet" type="text/css">

<button style="display: none" id="display" type="button" class="btn btn-primary mt-3 btn-animation" data-animation="rollIn" data-toggle="modal" data-target="#exampleModalLong-1">
    RollIn
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong-1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle-1">Votre panier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
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
                        <tr>
                            <td><?php echo $item["id"]; ?></td>
                            <td><?php echo $item["name"]; ?></td>
                            <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                            <td style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                            <td style="text-align:center;"><a href=""><i style="color: red;" class="mdi mdi-delete-forever"></i></a></td>
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
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CONTINUEZ VOS ACHATS</button>
                <button type="button" class="btn btn-primary">PASSEZ A LA CAISSE</button>
            </div>
        </div>
    </div>
</div>

<section id="section2" class="grid__col--12 panel--centered">
    <h2 class="headline-secondary"><?php echo $resto['restaurant']['name']; ?></h2>
    <h3 class="headline-third"><?php echo $resto['restaurant']['description']; ?></h3>
</section>

<section id="section5" class=" content-feature panel--padded--centered">
    <figure class="  grid__col--4">
        <a href="#"><img class="img-feature img--wrap" src="../public/upload/<?php echo $resto['dishes']['image']; ?>"></a>
    </figure>

    <article class="grid__col--4 feature-text">
        <br>
        <h1 class="headline-secondary"><?php echo $resto['dishes']['name']; ?></h1>
        <h3 class="headline-third">Prix: <?php echo $resto['dishes']['price']; ?>€</h3>

        <p class="centered">
            <?php echo $resto['dishes']['contenu']; ?>
        </p>
        <form method="post" action="/commande_add?id=<?php echo $resto['dishes']['id']; ?>">
            <div >
                <input type="number" name="quantity" value="1" style="width: 2rem;height: 2rem">
                <button class="btn--default" type="submit">Add</button>
            </div>
        </form>
    </article>
</section>

<hr>

<?php if (!empty($resto['comments']) && $resto['comments']!=NULL):?>

    <?php foreach ($resto['comments'] as $key => $value):?>
        <div class="container" id="<?php echo $value['id']; ?>">
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <div class="p-12">
                            <h5 class="font-16 m-b-15">L'avis de <?php echo $value['firstname']; ?> ******</h5>
                            <input type="hidden" name="rate" class="rating" data-filled="mdi mdi-heart font-32 text-danger" data-empty="mdi mdi-heart-outline font-32 text-danger" data-readonly value="<?php echo $value['star']; ?>"/>
                        </div>
                        <div class="form-group">
                            <label>Textarea</label>
                            <p><?php echo $value['contenu']; ?></p>
                        </div>
                    </div>
                    <?php if (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['admin']==true): ?>
                    <a class="btn btn-outline-danger" onclick="deleteComment(<?php echo $value['id']; ?>)">Supprimez</a>
                    <?php endif; ?>
                </div>
            </div>
            <hr>
        </div>
    <?php endforeach;?>

<?php endif; ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form method="post" action="add_comment?id_plat=<?php echo $resto['dishes']['id']; ?>&id_restaurant=<?php echo $resto['restaurant']['id']; ?>">
                <div>
                    <div class="p-12">
                        <h5 class="font-16 m-b-15">Veuillez donner votre avis de ce plat</h5>
                        <input type="hidden" name="rate" class="rating" data-filled="mdi mdi-heart font-32 text-danger" data-empty="mdi mdi-heart-outline font-32 text-danger"/>
                    </div>
                    <div class="form-group">
                        <label>Textarea</label>
                        <div>
                            <textarea required class="form-control" name="comment" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Envoyez
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
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

</script>

<script>
    $('.btn-animation').on('click', function(br) {
        //adding animation
        $('.modal .modal-dialog').attr('class', 'modal-dialog  swing  animated');
    });
</script>

<!-- Lance l'affichage de réussir de commander -->
<?php if (isset($_SESSION['display_success'])&&$_SESSION['display_success']==true): ?>
    <script>
        document.getElementById("display").click();
    </script>
    <?php unset($_SESSION['display_success']); ?>
<?php endif; ?>