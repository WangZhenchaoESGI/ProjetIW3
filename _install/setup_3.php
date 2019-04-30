<?php session_start();

    if (isset($_POST['DBDRIVER'])&&
        isset($_POST['DBHOST'])&&
        isset($_POST['DBNAME'])&&
        isset($_POST['DBUSER'])&&
        isset($_POST['DBPWD'])&&
        !file_exists("../conf.inc.php")
    ){
        $_SESSION['DBDRIVER'] = trim($_POST['DBDRIVER']);
        $_SESSION['DBHOST'] = trim($_POST['DBHOST']);
        $_SESSION['DBNAME'] = trim($_POST['DBNAME']);
        $_SESSION['DBUSER'] = trim($_POST['DBUSER']);
        $_SESSION['DBPWD'] = trim($_POST['DBPWD']);

        try{
            $pdo = new PDO($_SESSION['DBDRIVER'].":host=".$_SESSION['DBHOST'].";dbname=".$_SESSION['DBNAME'],$_SESSION['DBUSER'],$_SESSION['DBPWD']);
            //$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(Exception $e){
            $_SESSION['sql'] = $e->getMessage();
            header("Location: setup_2.php");
            exit();
        }

        //Ouvrir le fichier texte
        $handle = fopen("../conf.inc.php", "a+");

        $txt = "<?php
        define(\"DBDRIVER\", \"".$_SESSION['DBDRIVER']."\");
        define(\"DBHOST\", \"".$_SESSION['DBHOST']."\");
        define(\"DBNAME\", \"".$_SESSION['DBNAME']."\");
        define(\"DBUSER\", \"".$_SESSION['DBUSER']."\");
        define(\"DBPWD\", \"".$_SESSION['DBPWD']."\");
        define(\"TITLE\", \"".$_SESSION['nameSite']."\");             
        define(\"DESCRIPTION\", \"".$_SESSION['descriptionSite']."\");";

        fwrite($handle, $txt);
        fclose($handle);

        echo $txt;
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
        }
    </style>
</head>
<body>
<section id="section">
    <div class="content-wrapper is-hidden-mobile">
        <div class="text-wrapper">
            <h1 style="color: #0b0b0b">Configuration du site correct !</h1>

            <small>Vous avez finis tous les configuration de votre site. Et pour la sécurité, veuillez supprimer le dossier " Install ".</small>

        </div>
    </div>
</section>
</body>
</html>

