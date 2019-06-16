<div class="row commandes">
    <h3>Administration / Produits</h3>
</div>

<div class="row commandes" id="commandes-header">
    <h2>PRODUITS</h2>
    <figure>
        <a style="text-decoration: none;list-style: none" href="/add_produit">
            <img src="../public/img/icones/icons8-plus-80.png" width="35px" />
            <figcaption>Ajouter un Produit</figcaption>
        </a>
    </figure>
</div>

<div class="row commandes">
    <div id="commandes-content">
        <table class="table table-condensed">
            <caption style="text-align: left">PRODUITS <i style="border: 1px solid gainsboro;border-radius: 10px;padding: 1px;font-size: 10px;padding-left: 5px;padding-right: 5px;color: darkgrey;">14</i></caption>
            <thead>
            <tr>
                <th>ID</th>
                <th>NOM</th>
                <th>DESCRIPTION</th>
                <th>TARIF</th>
                <th>ENABLE</th>
                <th>DETAIL</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><input style="width: 60%;border-radius: 5px;height: 2em;"></td>
                <td><input style="width: 60%;border-radius: 5px;height: 2em;"></td>
                <td><input style="width: 70%;border-radius: 5px;height: 2em;"></td>
                <td><input style="width: 70%;border-radius: 5px;height: 2em;"></td>
                <td><input style="width: 30%;border-radius: 5px;height: 2em;"></td>
                <td><button  style="width: 100%;border-radius: 5px;height: 2.2em;text-align: left"><i class="fa fa-search"></i> CHERCHER</button></td>
            </tr>

            <?php foreach ($dishes as $key => $value):?>
                <tr>
                    <td><?php echo $value['id']; ?></td>
                    <td><?php echo $value['name']; ?></td>
                    <td><?php echo $value['contenu']; ?></td>
                    <td><?php echo $value['price']; ?>€</td>
                    <td><i class="fa fa-check" STYLE="color: #50E3C2;"></i></td>
                    <td><i class="fa fa-list"></i> ENTREZ</td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
    </div>
</div>