<div class="bs-component">
    <form
        action="/<?php echo $config['action']; ?>"
        method="POST"
        class=""
        id=""
        enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputPassword1">Votre nom de restaurant</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Votre nom de restaurant" value="<?php echo isset($config['restaurant']['name'])?$config['restaurant']['name']:""; ?>" required>
        </div>

        <div class="form-group">
            <label for="exampleInputPassword1">Votre description de restaurant</label>
            <input type="text" class="form-control" id="description" name="description" placeholder="Votre description de restaurant" value="<?php echo isset($config['restaurant']['description'])?$config['restaurant']['description']:""; ?>" required>
        </div>

        <div class="form-group">
            <label for="exampleSelect1">Catégory de votre restaurant</label>
            <select class="form-control" id="id_category" name="id_category" required>
                <?php foreach ($config["category"] as $key => $value):?>
                    <?php if ($value['id']==$config['restaurant']['id_category']): ?>
                        <option value="<?php echo $value["id"];?>" selected="selected"><?php echo $value["name"];?></option>
                    <?php else: ?>
                        <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
                    <?php endif; ?>
                <?php endforeach;?>
            </select>
        </div>

        <div class="form-group">
            <label for="exampleSelect1">Fonts de votre restaurant</label>
            <select class="form-control" id="id_fonts" name="id_fonts" required>
                <?php foreach ($config["fonts"] as $key => $value):?>
                    <?php if ($value['id']==$config['restaurant']['id_fonts']): ?>
                        <option value="<?php echo $value["id"];?>" selected="selected"><?php echo $value["name"];?></option>
                    <?php else: ?>
                        <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
                    <?php endif; ?>
                <?php endforeach;?>
            </select>
        </div>

        <fieldset class="form-group">
            <label for="exampleSelect1">Votre template de restaurant</label>

            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input"  id="optionsRadios1" name="template"  value="1" <?php echo isset($config['restaurant']['template'])&&$config['restaurant']['template']==1?"checked":""; ?>>
                    Template 1 <img src="../../public/img/template01.png" width="200px">
                </label>
            </div>
            <br>
            <div class="form-check">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input"  id="optionsRadios2" name="template" value="2"  <?php echo isset($config['restaurant']['template'])&&$config['restaurant']['template']==2?"checked":""; ?>>
                    Template 2 <img src="../../public/img/template1.png" width="200px">
                </label>
            </div>
        </fieldset>

        <div class="form-group">
            <label for="exampleSelect1">Le couleur de button</label>
            <input type="color" class="form-control" id="button" name="button" placeholder="Le couleur de button" value="<?php echo isset($config['restaurant']['button'])?$config['restaurant']['button']:""; ?>" required>
        </div>

        <div class="form-group">
            <label for="exampleSelect1">Le couleur de text</label>
            <input type="color" class="form-control" id="text" name="text" placeholder="Le couleur de text" value="<?php echo isset($config['restaurant']['text'])?$config['restaurant']['text']:""; ?>" required>
        </div>

        <div class="form-group">
            <label for="exampleInputFile">File input</label>
            <input type="file" class="form-control-file" id="photo" name="photo" aria-describedby="fileHelp" <?php echo isset($config['restaurant']['image'])?"":"required"; ?>>
        </div>

        <?php if (isset($config['restaurant']['image'])): ?>
            <div class="form-group">
                <img src="../../public/upload/<?php echo $config['restaurant']['image']; ?>" width="170px">
            </div>
        <?php endif; ?>

        <input type="submit" class="btn btn-outline-warning btn-block" value="Validez">
    </form>
</div>
