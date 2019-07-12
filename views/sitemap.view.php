<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Administration / Sitemap</h4>
        </div>
    </div>
</div>
<!-- end page title end breadcrumb -->

<div class="col-12">
    <div class="card m-b-30">
        <div class="card-body">

            <a class="btn btn-warning" href="../sitemap.xml" download> Téléchargez le sitemap </a>
            <pre>
                <xmp>
            <?php
            $date = date('Y-m-dTH:i:sP', time());

            echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
                                <urlset
                                      xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\"
                                      xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
                                      xsi:schemaLocation=\"http://www.sitemaps.org/schemas/sitemap/0.9
                                            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd\">

                                <url>
                                  <loc>http://wantwant.eu/</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>1.00</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/template</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/contact</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/connexion</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                <url>
                                  <loc>http://wantwant.eu/ajouter_un_utilisateur</loc>
                                  <lastmod>".$date."</lastmod>
                                  <priority>0.80</priority>
                                </url>
                                ";
            foreach ($data['t'] as $key => $value){
                echo "<url>
                      <loc>http://wantwant.eu/template?id=".$value['id']."</loc>
                      <lastmod>".$date."</lastmod>
                      <priority>0.64</priority>
                    </url>
                ";
            }

            foreach ($data['p']  as $key => $value){
                    echo "<url>
                      <loc>http://wantwant.eu/plat?id=".$value['id']."</loc>
                      <lastmod>".$date."</lastmod>
                      <priority>0.51</priority>
                    </url>
                ";
            }
            ?>
            </urlset>
            </xmp></pre>


        </div><!-- /.modal -->
    </div>
</div>
</div>