<?php session_start();

if (file_exists("../conf.inc.php")){
    header("Location: setup_3.php");
    exit();
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
            <h1 style="color: #0b0b0b">
                Merci de lancer l'installeur de votre site!
            </h1>

            <small class="form-text text-muted">These are the technical requirements to run our applications: PHP version: 7.1.3 or higher</small>
            <small class="form-text text-muted">Your PHP version : <i style="color: red;"><?php echo PHP_VERSION; ?></i></small>
            <br>

            <form method="post" action="setup_2.php">
                <fieldset>
                    <div class="form-group">
                        <label for="nameSite">Le nom de votre site</label>
                        <input type="text" class="form-control" id="nameSite" name="nameSite" placeholder="Entrez le nom de votre site" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea">Description de votre site</label>
                        <textarea class="form-control" id="exampleTextarea" name="descriptionSite" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn--default cta-button">SUIVANT</button>
                </fieldset>
            </form>
        </div>
    </div>
</section>
</body>
</html>
