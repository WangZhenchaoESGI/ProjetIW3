<body class="template-carte">
<div class="menu grid__col--12 panel--centered">
    <h1 class="headline-secondary ">LES RESTAURANT</h1>
</div>

<?php foreach ($resto as $key => $value):?>

    <div class="grid">
        <div class="menu grid__col--12 panel--centered">
            <div class="block-menu">
                <h2 class="headline-third"><?php echo $value['name']; ?></h2>
            </div>
        </div>
    </div>

    <a href="template?id=<?php echo $value['id']; ?>" style="text-decoration: none;list-style: none;">
        <section class="content-menu grid">
            <div class="menu-items grid__col--6 panel--centered">
                <h2 class="headline-third"><?php echo $value['name']; ?></h2>
                <p><?php echo $value['description']; ?></p>
            </div>
            <div class="menu-items grid__col--5 panel--centered">
                <img class="img--wrap" src="../public/upload/<?php echo $value['image']; ?>" alt="">
            </div>
        </section>
    </a>

<?php endforeach;?>

</body>