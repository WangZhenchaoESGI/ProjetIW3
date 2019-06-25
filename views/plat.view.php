
<section id="section2" class="grid__col--12 panel--centered">
    <h2 class="headline-secondary"><?php echo $resto['restaurant']['name']; ?></h2>
    <h3 class="headline-third"><?php echo $resto['restaurant']['description']; ?></h3>
</section>

<section id="section5" class=" content-feature panel--padded--centered">
    <figure class="  grid__col--4">
        <a href="#"><img class="img-feature img--wrap" src="../public/upload/<?php echo $resto['dishes']['image']; ?>"></a>
    </figure>

    <article class="grid__col--4 feature-text">
        <br>
        <h1 class="headline-secondary"><?php echo $resto['dishes']['name']; ?></h1>
        <h3 class="headline-third">Prix: <?php echo $resto['dishes']['price']; ?>€</h3>

        <p class="centered">
            <?php echo $resto['dishes']['contenu']; ?>
        </p>
        <form action="">
            <div >
                <input type="number" value="1" style="width: 2rem;height: 2rem">
                <button class="btn--default" type="submit">Add</button>
            </div>
        </form>
    </article>
</section>

<hr>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <form>
                <div>
                    <div class="p-12">
                        <h5 class="font-16 m-b-15">Veuillez donner votre avis de ce plat</h5>
                        <input type="hidden" class="rating" data-filled="mdi mdi-heart font-32 text-danger" data-empty="mdi mdi-heart-outline font-32 text-danger"/>
                    </div>
                    <div class="form-group">
                        <label>Textarea</label>
                        <div>
                            <textarea required class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-primary waves-effect waves-light">
                                Envoyez
                            </button>
                            <button type="reset" class="btn btn-secondary waves-effect m-l-5">
                                Cancel
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
