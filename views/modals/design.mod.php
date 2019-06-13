<div class="bs-component">
    <form
        action="/save_design"
        method="POST"
        class=""
        id="">

        <div class="form-group">
            <label for="exampleSelect1">Catégory de votre restaurant</label>
            <select class="form-control" id="fonts" name="fonts">
                <?php foreach ($config["category"] as $key => $value):?>
                    <option value="<?php echo $value["id"];?>"><?php echo $value["name"];?></option>
                <?php endforeach;?>
            </select>
        </div>

        <input type="submit" class="btn btn-outline-warning btn-block" value="Validez">
    </form>
</div>
