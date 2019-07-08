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

                </div>
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
</div>
