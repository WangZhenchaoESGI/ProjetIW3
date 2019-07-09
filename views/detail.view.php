<style>
    h3{
        color: black;
    }
</style>
<div class="container" style="margin-top: 3rem">
    <div class="row">
        <div class="col-3">
            <div class="card m-b-30">
                <div class="card-body">
                    <div class="sidebar-inner slimscrollleft">
                        <style>
                            a{
                                color: black;
                            }
                            i{
                                color: black;
                            }
                        </style>
                        <div id="sidebar-menu">
                            <ul>
                                <li>
                                    <a href="/client" class="btn btn-danger">
                                        Detail
                                    </a>
                                </li>
                                <br>
                                <?php if (isset($total_quantity)): ?>
                                    <li>
                                        <a class="btn btn-warning" href="/panier">PANIER
                                            <i style="border: 1px solid red;border-radius: 10px;background-color: red;color: white;">
                                                <?php echo $total_quantity; ?>
                                            </i>
                                        </a>
                                    </li>
                                    <br>
                                <?php endif; ?>
                                <li>
                                    <a href="/Commandes" class="btn btn-danger">
                                        Commandes
                                    </a>
                                </li>
                                <br>
                                <li>
                                    <a href="/deconnexion" class="btn btn-danger">
                                        Déconnexion
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div> <!-- end sidebarinner -->
                </div>
            </div>
        </div> <!-- end col -->
        <div class="col-9">
            <div class="card m-b-30">
                <div class="card-body">
                    <h3>Informations d'identification</h3>
                    <br>
                    <h5>Email: <?php echo $user['email']; ?></h5>
                    <br>
                    <?php
                    if (isset($_SESSION['error'])){
                        echo "<h4>".$_SESSION['error']."</h4>";
                        unset($_SESSION['error']);
                    }
                    ?>
                    <button class="btn btn-warning" onclick="display()">Modifier mon mot de passe</button>
                    <form style="display: none" method="post" action="/change_password" id="change_password">
                        <br><br>
                        <div class="form-group m-l-6">
                            <label class="sr-only" for="exampleInputPassword2">Nouveau mot de passe</label>
                            <input type="password" class="form-control ml-2" id="exampleInputPassword2" placeholder="Nouveau mot de passe" name="pwd1">
                        </div>
                        <div class="form-group m-l-6">
                            <label class="sr-only" for="exampleInputPassword2">Confirmez le mot de passe</label>
                            <input type="password" class="form-control ml-2" id="exampleInputPassword2" placeholder="Confirmez le mot de passe" name="pwd2">
                        </div>
                        <button type="submit" class="btn btn-danger ml-2">Validez</button>
                        <button class="btn btn-danger ml-2" type="reset" onclick="display_no()">Annulez</button>
                    </form>
                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>

<script>
    function display() {
        var pwd = document.getElementById("change_password");
        pwd.style.display = "";
    }
    function display_no() {
        var pwd = document.getElementById("change_password");
        pwd.style.display = "none";
    }
</script>
