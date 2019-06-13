<!DOCTYPE html>
<html>
      <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
            <meta name="description" content="">
            <title>Admin</title>
          <script src="../../public/js/nav-mobile.js"></script>
          <link rel="stylesheet" href="../../public/css/test.css">
          <script src="../../public/js/jquery.js"></script>
          <script src="../../public/js/script.js"></script>
          <script src="../../public/js/nav.js"></script>
            <link href="../../public/scss/admin.css" rel="stylesheet">
            <link href="../../public/css/admin.css" rel="stylesheet">
            <link href="../../public/css/tables.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      </head>
  <body>

  <nav class="row" id="header">
      <div class="col-xs-2
                  col-sm-2
                  col-md-2
                  col-lg-2">
          <a href="/"><img src="../../public/img/logo.png" id="logo_header"></a>
      </div>
      <div class="col-xs-2
                  col-sm-2
                  col-md-1
                  col-lg-1"
           id="shop"
      >
          <a href="#">Shop</a>
          <a href="#" id="profile"><img src="../../public/img/icones/icons8-male-user-52.png"></a>
      </div>
  </nav>

  <section class="navigation" id="nav-mobile">
      <div class="nav-container">
          <div class="brand">
              <a href="/dashboard"><img src="../../public/img/logo.png" id="logo-mobile" width="220px"></a>
          </div>
          <nav>
              <div class="nav-mobile"><a id="nav-toggle" href="#!"><span></span></a></div>
              <ul class="nav-list">
                  <li><a href="/dashboard"><img class="icone_nav" src="../../public/img/icones/icons8-speed-60.png">&nbsp;&nbsp;Dashboard</a></li>
                  <li><a href="/commandes"><img class="icone_nav" src="../../public/img/icones/icons8-todo-list-60.png">&nbsp;&nbsp;Commandes</a></li>
                  <li><a href="/produits"><img class="icone_nav" src="../../public/img/icones/icons8-soup-plate-60.png">&nbsp;&nbsp;Produits</a></li>
                  <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-close-sign-60.png">&nbsp;&nbsp;Fermetures</a></li>
                  <li><a href="/design"><img class="icone_nav" src="../../public/img/icones/icons8-html-5-60.png">&nbsp;&nbsp;Design</a></li>
                  <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-estimate-60.png">&nbsp;&nbsp;Facturations</a></li>
                  <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-contact-60.png">&nbsp;&nbsp;Contacts</a></li>
                  <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-info-60.png">&nbsp;&nbsp;FAQs</a></li>
                  <li><a href="/deconnexion"><img class="icone_nav" src="../../public/img/icones/icons8-info-60.png">&nbsp;&nbsp;Déconnexion</a></li>
              </ul>
          </nav>
      </div>
  </section>

  <div class="row" id="content">
      <div id="nav">
          <ul>
              <li><a href="/dashboard"><img class="icone_nav" src="../../public/img/icones/icons8-speed-60.png">&nbsp;&nbsp;Dashboard</a></li>
              <li><a href="/commandes"><img class="icone_nav" src="../../public/img/icones/icons8-todo-list-60.png">&nbsp;&nbsp;Commandes</a></li>
              <li><a href="/produits"><img class="icone_nav" src="../../public/img/icones/icons8-soup-plate-60.png">&nbsp;&nbsp;Produits</a></li>
              <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-close-sign-60.png">&nbsp;&nbsp;Fermetures</a></li>
              <li><a href="/design"><img class="icone_nav" src="../../public/img/icones/icons8-html-5-60.png">&nbsp;&nbsp;Design</a></li>
              <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-estimate-60.png">&nbsp;&nbsp;Facturations</a></li>
              <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-contact-60.png">&nbsp;&nbsp;Contacts</a></li>
              <li><a href=""><img class="icone_nav" src="../../public/img/icones/icons8-info-60.png">&nbsp;&nbsp;FAQs</a></li>
              <li><a href="/deconnexion"><img class="icone_nav" src="../../public/img/icones/icons8-info-60.png">&nbsp;&nbsp;Déconnexion</a></li>
          </ul>
      </div>
      <div  id="app">
          <?php include $this->v;?>
      </div>
  </div>

  </body>
</html>
