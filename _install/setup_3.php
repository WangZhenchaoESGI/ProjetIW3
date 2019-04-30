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

        // Installation de SQL
        $pdo->exec("
        -- phpMyAdmin SQL Dump
        -- version 4.6.6deb5
        -- https://www.phpmyadmin.net/
        --
        -- Host: localhost:3306
        -- Generation Time: 2019-04-30 14:13:32
        -- 服务器版本： 5.7.22-0ubuntu0.17.10.1
        -- PHP Version: 7.1.17-0ubuntu0.17.10.1
        
        SET SQL_MODE = \"NO_AUTO_VALUE_ON_ZERO\";
        SET time_zone = \"+00:00\";
        
        
        /*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
        /*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
        /*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
        /*!40101 SET NAMES utf8mb4 */;
        
        --
        -- Database: `mvcdocker2`
        --
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `address`
        --
        
        CREATE TABLE `address` (
          `id` int(11) NOT NULL,
          `addresse` varchar(255) NOT NULL,
          `city` varchar(50) NOT NULL,
          `postal` varchar(10) NOT NULL,
          `gps` varchar(255) NOT NULL,
          `phone` varchar(10) NOT NULL,
          `schedule` varchar(100) DEFAULT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `category`
        --
        
        CREATE TABLE `category` (
          `id` int(11) NOT NULL,
          `name` varchar(100) NOT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `category_dishes`
        --
        
        CREATE TABLE `category_dishes` (
          `id` int(11) NOT NULL,
          `id_restaurant` int(11) NOT NULL,
          `name` varchar(100) NOT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `comment`
        --
        
        CREATE TABLE `comment` (
          `id` int(11) NOT NULL,
          `id_restaurant` int(11) NOT NULL,
          `id_plat` int(11) NOT NULL,
          `star` tinyint(4) NOT NULL DEFAULT '0',
          `id_user` int(11) NOT NULL,
          `contenu` varchar(255) NOT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `dishes`
        --
        
        CREATE TABLE `dishes` (
          `id` int(11) NOT NULL,
          `name` varchar(100) NOT NULL,
          `contenu` text NOT NULL,
          `image` varchar(255) NOT NULL,
          `id_category_dishes` int(11) NOT NULL,
          `id_restaurant` int(11) NOT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `fonts`
        --
        
        CREATE TABLE `fonts` (
          `id` int(11) NOT NULL,
          `name` varchar(100) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `list_dishes_delivery`
        --
        
        CREATE TABLE `list_dishes_delivery` (
          `id` int(11) NOT NULL,
          `id_dishes` int(11) NOT NULL,
          `id_livraison` int(11) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `livraison`
        --
        
        CREATE TABLE `livraison` (
          `id` int(11) NOT NULL,
          `montant` float NOT NULL,
          `id_restaurant` int(11) NOT NULL,
          `id_client` int(11) NOT NULL,
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `id_ delivery` int(11) NOT NULL,
          `comment` int(11) NOT NULL,
          `status` tinyint(4) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `livraison_status`
        --
        
        CREATE TABLE `livraison_status` (
          `id` int(11) NOT NULL,
          `name` varchar(20) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        --
        -- 转存表中的数据 `livraison_status`
        --
        
        INSERT INTO `livraison_status` (`id`, `name`) VALUES
        (1, 'Non Payé'),
        (2, 'Payé');
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `restaurant`
        --
        
        CREATE TABLE `restaurant` (
          `id` int(11) NOT NULL,
          `name` int(11) NOT NULL,
          `id_category` tinyint(4) NOT NULL,
          `id_template` tinyint(4) NOT NULL,
          `id_fonts` int(11) NOT NULL,
          `color` varchar(6) NOT NULL,
          `id_user` int(11) NOT NULL,
          `id_address` int(11) NOT NULL,
          `status` tinyint(4) NOT NULL DEFAULT '1',
          `date_inserted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `role`
        --
        
        CREATE TABLE `role` (
          `id` tinyint(11) NOT NULL,
          `name` varchar(15) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        --
        -- 转存表中的数据 `role`
        --
        
        INSERT INTO `role` (`id`, `name`) VALUES
        (1, 'Client'),
        (2, 'Restaurateur'),
        (3, 'Admin');
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `template`
        --
        
        CREATE TABLE `template` (
          `id` int(11) NOT NULL,
          `path` varchar(255) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1;
        
        -- --------------------------------------------------------
        
        --
        -- 表的结构 `Users`
        --
        
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
        (1, 'Yves', 'SKRZYPCZYK', NULL, 'y.skrzypczyk@gmail.com', '$2y$10$aIxgdHwT.l/I/hNxFRt5mOjflQPAGtFevoAb/0X1gUMcl8DCGyGtq', 0, 1, NULL, '2018-12-10 14:02:56');
        
        --
        -- Indexes for dumped tables
        --
        
        --
        -- Indexes for table `address`
        --
        ALTER TABLE `address`
          ADD PRIMARY KEY (`id`);
        
        --
        -- Indexes for table `category`
        --
        ALTER TABLE `category`
          ADD PRIMARY KEY (`id`);
        
        --
        -- Indexes for table `category_dishes`
        --
        ALTER TABLE `category_dishes`
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
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `category`
        --
        ALTER TABLE `category`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `category_dishes`
        --
        ALTER TABLE `category_dishes`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `comment`
        --
        ALTER TABLE `comment`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `dishes`
        --
        ALTER TABLE `dishes`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `fonts`
        --
        ALTER TABLE `fonts`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `list_dishes_delivery`
        --
        ALTER TABLE `list_dishes_delivery`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `livraison`
        --
        ALTER TABLE `livraison`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        --
        -- 使用表AUTO_INCREMENT `livraison_status`
        --
        ALTER TABLE `livraison_status`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
        --
        -- 使用表AUTO_INCREMENT `role`
        --
        ALTER TABLE `role`
          MODIFY `id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
        --
        -- 使用表AUTO_INCREMENT `template`
        --
        ALTER TABLE `template`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
        --
        -- 使用表AUTO_INCREMENT `Users`
        --
        ALTER TABLE `Users`
          MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
        /*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
        /*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
        /*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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

