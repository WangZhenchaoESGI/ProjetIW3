<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo TITLE ?></title>
    <link rel="stylesheet" href="../../public/css/test.css">
    <link rel="stylesheet" href="../../public/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../../public/css/footer.css">
    <script src="../../public/js/jquery.js"></script>
    <script src="../../public/js/script.js"></script>
    <script src="../../public/js/nav.js"></script>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v3.3'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/fr_FR/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your customer chat code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="815514825475689"
         theme_color="#d4a88c"
         logged_in_greeting="Bonjour xD"
         logged_out_greeting="Bonjour xD">
    </div>
</head>
<body>

    <?php
    if(isset($_SESSION["cart_item"])) {
        $total_quantity = 0;
        $total_price = 0;
        foreach ($_SESSION["cart_item"] as $item){
            $item_price = $item["quantity"]*$item["price"];
            $total_quantity += $item["quantity"];
            $total_price += ($item["price"]*$item["quantity"]);
        }
    }
    ?>

    <nav class="navbar navbar-expand-lg header ">
        <a href="/" class="navbar-brand" id="logo-image"><img src="../public/img/logo-image.png" alt=""></a>

        <button class="navbar-toggler ml-auto" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="color: red;z-index: 999 !important;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor03">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">ACCUEIL <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/template">TEMPLATES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">CONTACT</a>
                </li>

                <?php if (isset($total_quantity)): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/panier">PANIER <i style="border: 1px solid red;border-radius: 10px;background-color: red;color: white;"><?php echo $total_quantity; ?></i></a>
                    </li>
                <?php endif; ?>

                <?php if (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['pro']==true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">MyEatFood</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion">DECONNEXION</a>
                    </li>
                <?php elseif (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['client']==true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/client">MyEatFood</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion">DECONNEXION</a>
                    </li>
                <?php elseif (isset($_SESSION['role']['isConnected']) && $_SESSION['role']['isConnected']==true && $_SESSION['role']['admin']==true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/dashboard">Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/deconnexion">DECONNEXION</a>
                    </li>
                <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="/connexion">CONNEXION</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/ajouter_un_utilisateur">INSCRIPTION</a>
                </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>


    <?php include $this->v;?>

    <footer class="footer-distributed footer-home  panel--padded">

        <div class="footer-left">

            <h3><img src=".././public/img/logo-image.png" width="150px"></h3>

            <p class="footer-links">
                <a href="/">Accueil</a>
                ·
                <a href="#">Blog</a>
                ·
                <a href="/template">Template</a>
                ·
                <a href="/connexion">Connexion</a>
                ·
                <a href="/contact">Contact</a>
            </p>

            <p class="footer-company-name">Company EatFood &copy; 2019</p>
        </div>

        <div class="footer-center">

            <div>
                <i class="fa fa-map-marker"></i>
                <p><span>21 Revolution Street</span> Paris, France</p>
            </div>

            <div>
                <i class="fa fa-phone"></i>
                <p>+1 555 123456</p>
            </div>

            <div>
                <i class="fa fa-envelope"></i>
                <p><a href="mailto:support@company.com">support@company.com</a></p>
            </div>

        </div>

        <div class="footer-right">

            <p class="footer-company-about">
                <span>About the company</span>
                Lorem ipsum dolor sit amet, consectateur adispicing elit. Fusce euismod convallis velit, eu auctor lacus vehicula sit amet.
            </p>

            <div class="footer-icons">

                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-linkedin"></i></a>
                <a href="#"><i class="fa fa-github"></i></a>

            </div>

        </div>

    </footer>
</body>
</html>
