<!--

<body class="template">
<header class=" header-temp">
    <a href="#" id="logo-image-temp"><img src="../public/img/logo_front_pourpre.png" alt=""></a>
    <nav class="navbar" role="navigation">
      <span id="toggle" class="icn--nav-toggle is-displayed-mobile">
        <b class="srt">Toggle</b>
      </span>
        <ul class="nav is-collapsed-mobile">
            <li class="nav__item"><a href="#">COMMANDER</a></li>
            <li class="nav__item"><a href="/template-carte" target="_blank">LA CARTE</a></li>
            <li class="nav__item"><a href="/reservation">RESERVATION</a></li>
            <li class="nav__item"><a href="/contact" target="_blank">OÙ NOUS TROUVER</a></li>
        </ul>
    </nav>
</header>


<section id="section-template">
    <div class="img-temp is-hidden-mobile">
        <div class="wrapper-text">
            <h1 class="headline-primary">
                BIENVENUE AU TRIADOU
            </h1>
        </div>
    </div>
</section>

<section class="description feature-temp grid">
    <article class="grid__col--3 hero-img-temp">
        <a href="#"><img class="img--avatar" src="../public/img/chef/aaron-thomas-569554-unsplash.jpg" alt=""></a>
        <div class="text-description">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Aspernatur tenetur aperiam sed ad deleniti dolores necessitatibus rerum earum
            </p>
        </div>
    </article>
    <article class="grid__col--3 hero-img-temp">
        <img class="img--avatar" src="../public/img/chef/steven-cleghorn-279421-unsplash.jpg" alt="">
        <div class="text-description">
            <p class="centered">Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Aspernatur tenetur aperiam sed ad deleniti dolores necessitatibus rerum earum
            </p>
        </div>
    </article>
    <article class="grid__col--3 hero-img-temp">
        <img class="img--avatar" src="../public/img/chef/rawpixel-1298251-unsplash.jpg" alt="">
        <div class="text-description">
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit.
                Aspernatur tenetur aperiam sed ad deleniti dolores necessitatibus rerum earum
            </p>
        </div>
    </article>
</section>

<section class="section-plat panel--padded--centered grid__col--12">
    <h1 class="headline-third ">Chaque plat atteint cet équilibre insaisissable entre<br> le sucré, le salé et l'amertume qui définit une cuisine — même <br>le dessert.</h1>
    <div class="grid__col--12">
        <a href="#"><img class="img-menu img--hero grid__col--4" src="../public/img/augustine-fou-622742-unsplash.jpg"></a>
        <a href="#"><img class="img-menu img--hero grid__col--4" src="../public/img/luiz-hansel-1183634-unsplash.jpg"></a>
        <a href="#"><img class="img-menu img--hero grid__col--4" src="../public/img/elle-cosgrave-1144477-unsplash.jpg"></a>
    </div>
</section>

<section id="section-interieur" class="panel--padded--centered grid__col--12">
    <h1 class="headline-third ">Notre mission est simple : <br>servir des plats délicieux et abordables<br>dans un cadre agréable que les clients <br>voudront commander semaine après semaine.</h1>
    <div class="img-interieur-resto grid__col--12">
        <a href="#"><img class="img-resto img--hero grid__col--5" src="../public/img/restau/mariya-fish-1299651-unsplash.jpg"></a>
        <a href="#"><img class="img-resto img--hero grid__col--3" src="../public/img/stefan-johnson-124184-unsplash.jpg"></a>
    </div>
</section>

</body>
-->

<?php if (isset($_SESSION['id_restaurant']) && ($_SESSION['id_restaurant'] != $_GET['id'])):?>
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
                    <p>Attention, si vous ajoutez un produit de ce restaurant, votre panier actuel sera vidé
                    </p>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">CONTINUEZ VOS ACHATS</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById("display").click();
    </script>

<?php endif; ?>

<section id="section1">
    <div class="content-wrapper is-hidden-mobile">
        <div class="text-wrapper">
            <h1 class="headline-primary">
                Bievenue sur notre restaurant !
            </h1>
        </div>
    </div>
</section>

<section id="section2" class="grid__col--12 panel--centered">
    <h2 class="headline-secondary" style="color: red;">
        <?php if (isset($_SESSION['error'])){
            echo $_SESSION['error'];
            unset($_SESSION['error']);
        } ?>
    </h2>
    <h2 class="headline-secondary"><?php echo $resto['restaurant']['name']; ?></h2>
    <h3 class="headline-third"><?php echo $resto['restaurant']['description']; ?></h3>
</section>

<section class="container-fluid">
    <div class="row">
        <?php if (!empty($resto['dishes']) && $resto['dishes']!=NULL):?>

            <?php foreach ($resto['dishes'] as $key => $value):?>
                <div class="col-md-4" style="text-align: center">
                    <a href="/plat?id=<?php echo $value['id']; ?>" target="_blank">
                    <figure class="hero-image" style="background-image: url('../public/upload/<?php echo $value['image']; ?>')">
                    </figure>
                    <p>
                        <?php echo $value['name']; ?>
                        <?php echo "<i style='color: darkgrey;'>Prix: ".$value['price']."€</i>"; ?>

                    </p>
                    </a>
                    <div class="hero-text">
                        <a class="btn--default" href="/plat?id=<?php echo $value['id']; ?>">Commandez</a>
                    </div>
                </div>

            <?php endforeach;?>

        <?php endif; ?>
    </div>
</section>