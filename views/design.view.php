<div class="row commandes">
    <h3>Administration / Design</h3>
</div>

<div class="row commandes">
    <div id="commandes-content">

        <h5>Le nom de restaurant: <?php echo $data['restaurant']['name'] ?></h5>
        <h5>La description de restaurant: <?php echo $data['restaurant']['description'] ?></h5>
        <h5>La catégorie de restaurant: <?php echo $data['category']['name'] ?></h5>
        <h5>Le fonts de restaurant: <?php echo $data['fonts']['name'] ?></h5>
        <h5>La template de restaurant: <?php echo $data['restaurant']['template'] ?></h5>
        <?php
        switch ($data['restaurant']['template']){
            case 1: echo "<img src='../public/img/template01.png' width='50%'>";
            break;
            case 2: echo "<img src='../public/img/template1.png' width='50%'>";
            break;
        }
        ?>
        <h5 style="color: <?php echo $data['restaurant']['button']; ?>">Le couleur de Button</h5>
        <h5 style="color: <?php echo $data['restaurant']['text']; ?>">Le couleur de Text</h5>
        <h5>Le status de restaurant: <?php echo $data['restaurant']['status']==1?"Normal":"Fermé"; ?></h5>

        <a class="btn btn-warning" href="/update_design">Modifez</a>
    </div>
</div>