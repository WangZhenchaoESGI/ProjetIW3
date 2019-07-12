<?php session_start();

if (file_exists("../conf.inc.php")){
    header("Location: setup_3.php");
    exit();
}

if (!isset($_SESSION['nameSite'] ) && !isset($_SESSION['descriptionSite'] )){
    $_SESSION['nameSite'] = $_POST['nameSite'];
    $_SESSION['descriptionSite'] = $_POST['descriptionSite'];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>EatFood</title>
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/css/footer.css">
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../public/css/test.css">
    <script src="../public/js/jquery.js"></script>
    <script src="../public/js/script.js"></script>
    <style>
        .content-wrapper{
            background-image: none;
            height: 100%;
        }
    </style>
</head>
<body>
<section id="section">
    <div class="content-wrapper is-hidden-mobile">
        <div class="text-wrapper">
            <h1 style="color: #0b0b0b">
                Configuration de la Base de donnée !
            </h1>

            <?php

            if (isset($_SESSION['sql'])){
                echo "<small class=\"form-text text-muted\" style='color: red'>Erreur de connexion de SQL : ". $_SESSION['sql'] ."</small>
";
                unset($_SESSION['sql']);
            }

            ?>
            <br>
            <form method="post" action="setup_3.php">
                <fieldset>
                    <div class="form-group">
                        <label for="nameSite">DBDRIVER</label>
                        <input type="text" class="form-control" id="DBDRIVER" name="DBDRIVER" value="mysql" required>
                    </div>
                    <div class="form-group">
                        <label for="nameSite">DBHOST</label>
                        <input type="text" class="form-control" id="DBHOST" name="DBHOST" value="localhost" required>
                    </div>
                    <div class="form-group">
                        <label for="nameSite">DBNAME</label>
                        <input type="text" class="form-control" id="DBNAME" name="DBNAME" value="mvcdocker2" required>
                    </div>
                    <div class="form-group">
                        <label for="nameSite">DBUSER</label>
                        <input type="text" class="form-control" id="DBUSER" name="DBUSER" value="root" required>
                    </div>
                    <div class="form-group">
                        <label for="nameSite">DBPWD</label>
                        <input type="text" class="form-control" id="DBPWD" name="DBPWD" value="password" required>
                    </div>
                    <button type="submit" class="btn--default cta-button">SUIVANT</button>
                </fieldset>
            </form>
        </div>
    </div>
</section>
</body>
</html>
