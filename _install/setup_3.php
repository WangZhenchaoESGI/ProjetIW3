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

        // Installation de SQL
        $pdo->exec("
            SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
            SET time_zone = \"+00:00\";
            
            CREATE TABLE `address` (
              `id` int(11) NOT NULL,
              `name` varchar(255) NOT NULL,
              `addresse` varchar(255) NOT NULL,
              `city` varchar(50) NOT NULL,
              `postal` varchar(20) NOT NULL,
              `phone` varchar(20) NOT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `code` varchar(60) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `category` (
              `id` int(11) NOT NULL,
              `name` varchar(100) CHARACTER SET utf8 NOT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            INSERT INTO `category` (`id`, `name`, `date_inserted`) VALUES
            (1, 'francais', '2019-05-28 20:29:11'),
            (2, 'italien', '2019-05-28 20:29:11'),
            (3, 'japonais', '2019-05-28 20:29:28'),
            (4, 'pizza', '2019-05-28 20:29:28'),
            (5, 'chinois', '2019-05-28 20:29:47'),
            (6, 'indien', '2019-05-28 20:29:47'),
            (7, 'burger', '2019-05-28 20:30:17'),
            (8, 'kebab', '2019-05-28 20:30:17'),
            (9, 'wok', '2019-05-28 20:30:31'),
            (10, 'turc', '2019-05-28 20:30:31'),
            (11, 'halal', '2019-05-28 20:31:00'),
            (12, 'fruits de mer', '2019-05-28 20:31:00');
            
            CREATE TABLE `comment` (
              `id` int(11) NOT NULL,
              `id_restaurant` int(11) NOT NULL,
              `id_plat` int(11) NOT NULL,
              `star` tinyint(4) NOT NULL DEFAULT '0',
              `id_user` int(11) NOT NULL,
              `contenu` varchar(255) NOT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `dishes` (
              `id` int(11) NOT NULL,
              `name` varchar(100) NOT NULL,
              `contenu` text NOT NULL,
              `image` varchar(255) NOT NULL,
              `price` float NOT NULL,
              `status` tinyint(2) NOT NULL DEFAULT '1',
              `id_restaurant` int(11) NOT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `fonts` (
              `id` int(11) NOT NULL,
              `name` varchar(100) NOT NULL,
              `content` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            INSERT INTO `fonts` (`id`, `name`, `content`) VALUES
            (1, 'Arial', 'Arial, Helvetica, sans-serif'),
            (2, 'Comic Sans MS', '\'Comic Sans MS\', cursive'),
            (3, 'Courier New', '\'Courier New\', Courier, monospace');
            
            
            CREATE TABLE `list_dishes_delivery` (
              `id` int(11) NOT NULL,
              `id_dishes` int(11) NOT NULL,
              `quantity` int(11) NOT NULL DEFAULT '0',
              `code` varchar(60) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `livraison` (
              `id` int(11) NOT NULL,
              `montant` float NOT NULL,
              `id_method` tinyint(4) NOT NULL,
              `id_restaurant` int(11) NOT NULL,
              `id_client` int(11) NOT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `status` tinyint(4) NOT NULL,
              `code` varchar(60) NOT NULL,
              `vue` tinyint(4) NOT NULL DEFAULT '0'
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `livraison_status` (
              `id` int(11) NOT NULL,
              `name` varchar(20) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            INSERT INTO `livraison_status` (`id`, `name`) VALUES
            (1, 'Non Payé'),
            (2, 'Payé');
            
            
            CREATE TABLE `method` (
              `id` int(11) NOT NULL,
              `name` varchar(20) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            INSERT INTO `method` (`id`, `name`) VALUES
            (1, 'Paypal'),
            (2, 'Buyster'),
            (3, 'Especes'),
            (4, 'Carte Banciare'),
            (5, 'Tikets Restaurants'),
            (6, 'Cheques'),
            (7, 'Corporate');
            
            
            CREATE TABLE `restaurant` (
              `id` int(11) NOT NULL,
              `name` varchar(255) CHARACTER SET utf8 NOT NULL,
              `description` text CHARACTER SET utf8 NOT NULL,
              `id_category` tinyint(4) NOT NULL,
              `template` tinyint(4) NOT NULL,
              `id_fonts` int(11) NOT NULL,
              `button` varchar(10) CHARACTER SET utf8 NOT NULL,
              `text` varchar(10) CHARACTER SET utf8 NOT NULL,
              `id_user` int(11) NOT NULL,
              `image` varchar(255) CHARACTER SET utf8 NOT NULL,
              `status` tinyint(4) NOT NULL DEFAULT '1',
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            CREATE TABLE `role` (
              `id` tinyint(11) NOT NULL,
              `name` varchar(15) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            
            INSERT INTO `role` (`id`, `name`) VALUES
            (1, 'Client'),
            (2, 'Restaurateur'),
            (3, 'Admin');
            
            CREATE TABLE `template` (
              `id` int(11) NOT NULL,
              `name` varchar(50) NOT NULL,
              `path` varchar(255) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            INSERT INTO `template` (`id`, `name`, `path`) VALUES
            (1, 'Template1', 'template1'),
            (2, 'Template2', 'template2');
            
            
            CREATE TABLE `Users` (
              `id` int(11) NOT NULL,
              `firstname` varchar(50) NOT NULL,
              `lastname` varchar(100) NOT NULL,
              `phone` varchar(20) DEFAULT NULL,
              `email` varchar(250) NOT NULL,
              `pwd` varchar(60) NOT NULL,
              `status` tinyint(4) NOT NULL,
              `role` tinyint(4) NOT NULL,
              `accesstoken` varchar(32) DEFAULT NULL,
              `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
            
            --
            -- 转存表中的数据 `Users`
            --
            
            INSERT INTO `Users` (`id`, `firstname`, `lastname`, `phone`, `email`, `pwd`, `status`, `role`, `accesstoken`, `date_inserted`) VALUES
            (2, 'Zhenchao132', 'WANG', NULL, 'wangzhenchao@test.com', '$2y$10$7heMCPLlmEC.ilcN3LXU8eUpKqmGKmxjwQzuEKe0FSOKsv.0B3PJy', 1, 2, 'b01aa34da95ceb7ab4417cb0de8b6d98', '2019-04-30 13:41:10'),
            (6, 'Wang', 'ZHENCHAO', NULL, 'lucien33@live.com', '$2y$10$k.XNPbSQ5/iBl0clmFX.5.kJghQ71OBBx3/eautWvSkpOniJC0u6K', 1, 1, 'e958faade896563e98b721e255a08906', '2019-05-26 22:00:43'),
            (7, 'Wang', 'ZHENCHAO', NULL, 'info.lwfr@gmail.com', '$2y$10$6iSAu/TP2KjLjVivTjv2ROrCp1SnbIxpHb6ZFd1c4MLfGWYiitSfe', 1, 2, 'c4732a48e088e64fcb298cbf0c8a0bc0', '2019-05-26 22:27:16'),
            (8, 'Zhenchao', 'WANG', NULL, 'luciend33@live.com', '$2y$10$i8yASRYjxp75TEg4hw/h0ew7q7wlaC9mNOTv0Eg7bfM0SLUB0t.Ym', 0, 1, '62bc1f659bb300b75c2226a3ff9a5772', '2019-06-27 15:47:48'),
            (9, 'Zhenchao', 'WANG', NULL, 'lucien3@live.com', '$2y$10$lEBd7P7deok.tyX/pL/lKuz//KO3puKSv9LYHrQj6TrRbmk6/OS2S', 1, 3, '799e5ec1b8c80df7f16ea623c03a470a', '2019-07-11 14:50:49'),
            (10, 'Zhenchao', 'WANG', NULL, 'lucien@live.com', '$2y$10$V0SAwiKBuf.5r/08dcYOZ.bcSqi3HE7NAiPZb6D2TK/X30bfCpfCO', 1, 2, 'f5b61db9fd622829a3923eeee64fc413', '2019-07-11 15:06:12');
            
            ALTER TABLE `address`
              ADD PRIMARY KEY (`id`),
              ADD UNIQUE KEY `id` (`id`);
            
            --
            -- Indexes for table `category`
            --
            ALTER TABLE `category`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `comment`
            --
            ALTER TABLE `comment`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `dishes`
            --
            ALTER TABLE `dishes`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `fonts`
            --
            ALTER TABLE `fonts`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `list_dishes_delivery`
            --
            ALTER TABLE `list_dishes_delivery`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `livraison`
            --
            ALTER TABLE `livraison`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `livraison_status`
            --
            ALTER TABLE `livraison_status`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `method`
            --
            ALTER TABLE `method`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `restaurant`
            --
            ALTER TABLE `restaurant`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `role`
            --
            ALTER TABLE `role`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `template`
            --
            ALTER TABLE `template`
              ADD PRIMARY KEY (`id`);
            
            --
            -- Indexes for table `Users`
            --
            ALTER TABLE `Users`
              ADD PRIMARY KEY (`id`);
            
            --
            -- 在导出的表使用AUTO_INCREMENT
            --
            
            --
            -- 使用表AUTO_INCREMENT `address`
            --
            ALTER TABLE `address`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
            --
            -- 使用表AUTO_INCREMENT `category`
            --
            ALTER TABLE `category`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
            --
            -- 使用表AUTO_INCREMENT `comment`
            --
            ALTER TABLE `comment`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
            --
            -- 使用表AUTO_INCREMENT `dishes`
            --
            ALTER TABLE `dishes`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
            --
            -- 使用表AUTO_INCREMENT `fonts`
            --
            ALTER TABLE `fonts`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
            --
            -- 使用表AUTO_INCREMENT `list_dishes_delivery`
            --
            ALTER TABLE `list_dishes_delivery`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
            --
            -- 使用表AUTO_INCREMENT `livraison`
            --
            ALTER TABLE `livraison`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
            --
            -- 使用表AUTO_INCREMENT `livraison_status`
            --
            ALTER TABLE `livraison_status`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
            --
            -- 使用表AUTO_INCREMENT `method`
            --
            ALTER TABLE `method`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
            --
            -- 使用表AUTO_INCREMENT `restaurant`
            --
            ALTER TABLE `restaurant`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
            --
            -- 使用表AUTO_INCREMENT `role`
            --
            ALTER TABLE `role`
              MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
            --
            -- 使用表AUTO_INCREMENT `template`
            --
            ALTER TABLE `template`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
            --
            -- 使用表AUTO_INCREMENT `Users`
            --
            ALTER TABLE `Users`
              MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

        ");
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

