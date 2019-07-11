<div class="row">
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-webcam"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-center">
                        <div class="m-l-10">
                            <h5 class="mt-0 round-inner"><?php echo $data['total_plat']; ?></h5>
                            <p class="mb-0 text-muted">Total de plats </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-account-multiple-plus"></i>
                        </div>
                    </div>
                    <div class="col-9 text-center align-self-center">
                        <div class="m-l-10">
                            <h5 class="mt-0 round-inner"><?php echo($data['total_livraison']) ; ?></h5>
                            <p class="mb-0 text-muted">Commandes Aujourd'hui</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round ">
                            <i class="mdi mdi-basket"></i>
                        </div>
                    </div>
                    <div class="col-9 align-self-center text-center">
                        <div class="m-l-10">
                            <h5 class="mt-0 round-inner"><?php echo($data['total_montant']) ; ?>€</h5>
                            <p class="mb-0 text-muted">Gagné Aujourd'hui</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
    <!-- Column -->
    <div class="col-md-6 col-lg-6 col-xl-3">
        <div class="card m-b-30">
            <div class="card-body">
                <div class="d-flex flex-row">
                    <div class="col-3 align-self-center">
                        <div class="round">
                            <i class="mdi mdi-rocket"></i>
                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center">
                        <div class="m-l-10">
                            <h5 class="mt-0 round-inner"><?php echo($data['total']) ; ?>€</h5>
                            <p class="mb-0 text-muted">Gagné total</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Column -->
</div>
<div class="row">
    <div class="col-md-12 col-lg-12 col-xl-8">
        <div class="card m-b-30">
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr style="background-color: #D0021B">
                        <th style="text-align: center;">Paiements</th>
                        <th style="text-align: center;">Commandes</th>
                        <th style="text-align: center;">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    $item = 0;
                    $montant = 0;

                    foreach ($data['statistique'] as $key => $value){
                        echo "<tr>";
                        echo "<td>".$value['name']."</td>";
                        echo "<td style=\"text-align: right\">".$value['total']."</td>";
                        echo "<td style=\"text-align: right\">".$value['montant']."€</td>";
                        echo "</tr>";
                        $item += $value['total'];
                        $montant += $value['montant'];
                    }

                    ?>
                    <tr style="background-color: #F5A123">
                        <td>Tautaux</td>
                        <td style="text-align: right"><?php echo $item; ?></td>
                        <td style="text-align: right"><?php echo $montant; ?>€</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-12 col-xl-4">
        <div class="card m-b-30">
            <div class="card-body">
                <script src="https://code.highcharts.com/highcharts.js"></script>
                <script src="https://code.highcharts.com/modules/data.js"></script>
                <script src="https://code.highcharts.com/modules/drilldown.js"></script>

                <div id="container1" style="width: 100%; height: 400px; margin: 0 auto"></div>

                <!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->
                <pre id="tsv" style="display:none">Statistiques</pre>
                <script>

                    // Create the chart
                    Highcharts.chart('container1', {
                        chart: {
                            type: 'pie'
                        },
                        title: {
                            text: 'Statistiques. <?php echo date("d M Y"); ?>'
                        },
                        plotOptions: {
                            series: {
                                dataLabels: {
                                    enabled: true,
                                    format: '{point.name}: {point.y:.1f}%'
                                }
                            }
                        },

                        tooltip: {
                            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                        },

                        "series": [
                            {
                                "name": "Statistiques",
                                "colorByPoint": true,
                                "data": [
                                    <?php foreach ($data['statistique'] as $key => $value): ?>
                                    {
                                        "name": "<?php echo $value['name']; ?>",
                                        "y": <?php echo $value['montant']/$data['total_montant']*100; ?>
                                    },
                                    <?php endforeach; ?>
                                ]
                            }
                        ]
                    });
                </script>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xl-12">
            <div class="card m-b-30">
                <div class="card-body">
                    <!--  chart start -->
                    <div>
                        <div id="container2" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
                        <div id="container2" style="min-width: 310px; margin: 0 auto"></div>
                        <pre id="data" style="display: none;">Date,Quantité
                            <?php
                            foreach ($data['courbes'] as $r){
                                echo $r['month'].",".$r['piece']."\n";
                            }
                            ?>
                        </pre>

                        <script type="text/javascript">
                            Highcharts.chart('container2', {
                                data: {
                                    csv: document.getElementById('data').innerHTML
                                },
                                yAxis: {
                                    title: {
                                        text: 'Share prices'
                                    }
                                },
                                plotOptions: {
                                    series: {
                                        marker: {
                                            enabled: false
                                        }
                                    }
                                },
                                title: {
                                    text: 'Statistique de la commande'
                                },
                                subtitle: {
                                    text: 'Quantité de la commande par jour'
                                }
                            });
                        </script>
                    </div>
                    <!--  chart fin  -->
                </div>
            </div>
        </div>
    </div>
</div>