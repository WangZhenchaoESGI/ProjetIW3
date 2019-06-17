<div class="bs-component">
    <form
        action="/<?php echo $config['action']; ?>"
        method="POST"
        class=""
        id=""
        enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputPassword1">Le nom de plat</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Le nom de plat" value="<?php echo isset($config['produit']['name'])?$config['produit']['name']:""; ?>" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">La description de plat</label>
            <textarea id="contenu" name="contenu" required>
                <?php echo isset($config['produit']['contenu'])?$config['produit']['contenu']:"La description de plat"; ?>
            </textarea>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Le prix de plat</label>
            <input type="text" class="form-control" id="price" name="price" placeholder="Le prix de plat" value="<?php echo isset($config['produit']['price'])?$config['produit']['price']:""; ?>" onkeyup="this.value=(this.value.match(/\d+(\.\d{0,2})?/)||[''])[0]" required>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" id="photo" name="photo" aria-describedby="fileHelp" <?php echo isset($config['produit']['image'])?"":"required"; ?>>
        </div>

        <div class="form-group">
            <img src="../../public/upload/<?php echo $config['produit']['image']; ?>" width="170px">
        </div>
        
        <input type="submit" class="btn btn-outline-warning btn-block" value="Validez">
    </form>
</div>

<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
<script>tinymce.init({ selector:'textarea' });</script>