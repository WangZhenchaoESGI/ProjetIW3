<div class="row" id="dashboard">
    <div class="col-xs-12
                col-sm-12
                col-md-6
                col-lg-6"
    >

        <h3 style="font-family: Chalkduster">Statiques du mois Février 2019</h3>
        <h4 style="font-family: Chalkduster">Statiques du mois Février 2019</h4>
        <h5 style="color: #9B9B9B;">Aucune commande annulé ce mois</h5>
        <h4 style="font-family: Chalkduster">Statiques du mois Février 2019</h4>
        <table class="table table-bordered">
            <thead>
            <tr style="background-color: #D0021B">
                <th style="text-align: center;">Paiements</th>
                <th style="text-align: center;">Commandes</th>
                <th style="text-align: center;">Total</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Paypal</td>
                <td style="text-align: right">9</td>
                <td style="text-align: right">443€</td>
            </tr>
            <tr style="background-color: gainsboro">
                <td>Buyster</td>
                <td style="text-align: right">19</td>
                <td style="text-align: right">43€</td>
            </tr>
            <tr>
                <td>Carte Banciare</td>
                <td style="text-align: right">19</td>
                <td style="text-align: right">93€</td>
            </tr>
            <tr style="background-color: gainsboro">
                <td>Espèces</td>
                <td style="text-align: right">25</td>
                <td style="text-align: right">193€</td>
            </tr>
            <tr>
                <td>Tikets Restaurants</td>
                <td style="text-align: right">19</td>
                <td style="text-align: right">293€</td>
            </tr>
            <tr style="background-color: gainsboro">
                <td>Chèques</td>
                <td style="text-align: right">0</td>
                <td style="text-align: right">0€</td>
            </tr>
            <tr>
                <td>Corporate</td>
                <td style="text-align: right">19</td>
                <td style="text-align: right">293€</td>
            </tr>
            <tr style="background-color: #F5A123">
                <td>Tautaux</td>
                <td style="text-align: right">100</td>
                <td style="text-align: right">2900€</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div class="col-xs-12
                col-sm-12
                col-md-6
                col-lg-6"
    >
        <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/drilldown.js"></script>

        <div id="container" style="width: 100%; height: 400px; margin: 0 auto"></div>

        <!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->
        <pre id="tsv" style="display:none">Statistiques</pre>
        <script>

            // Create the chart
            Highcharts.chart('container', {
                chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Statistiques. Février, 2019'
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
                            {
                                "name": "Paypal",
                                "y": 62.74
                            },
                            {
                                "name": "Chèques",
                                "y": 10.57
                            },
                            {
                                "name": "Carte bancaire",
                                "y": 7.23
                            },
                            {
                                "name": "Tiket restaurant",
                                "y": 5.58
                            },
                            {
                                "name": "Buyster",
                                "y": 4.02
                            },
                            {
                                "name": "Espèces",
                                "y": 1.92
                            },
                            {
                                "name": "Corporate",
                                "y": 7.62
                            }
                        ]
                    }
                ]
            });
        </script>
    </div>
</div>