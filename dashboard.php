<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    $user = $_SESSION['user'];

    //get graph data - supplier product report
    include('database/supplier_product_bar_graph.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./css/dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <div id="mainContainer">
    <?php include('partials/app-sidebar.php') ?>

        <div class="dashboard_container" id="dashboard_container">
        <?php include('partials/app-topnav.php') ?>

            <div class="content">
                <div class="main">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                            <p class="highcharts-description">
                                Bar graph of product count assigned to suppliers
                            </p>
                    </figure>
                </div>
            </div>
        </div>
    </div>

<script src="./js/script.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script>
    var barGraphData = <?= json_encode($bar_chart_data) ?>;
    var barGraphCategories = <?= json_encode($categories) ?>;

    console.log(barGraphCategories, barGraphData);

    Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'Product Count Assigned To Supplier',
        align: 'left'
    },
    xAxis: {
        categories: barGraphCategories,
        title: {
            text: null
        },
        gridLineWidth: 1,
        lineWidth: 0
    },
    yAxis: {
        min: 0,
        title: {
            text: 'Product count',
            align: 'high'
        },
        labels: {
            overflow: 'justify'
        },
        gridLineWidth: 0
    },
    tooltip: {
        valueSuffix: ' '
    },
    plotOptions: {
        bar: {
            borderRadius: '50%',
            dataLabels: {
                enabled: true
            },
            groupPadding: 0.1
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor:
            Highcharts.defaultOptions.legend.backgroundColor || '#FFFFFF',
        shadow: true
    },
    credits: {
        enabled: false
    },
    series: [{
        name: 'suppliers',
        data: barGraphData
    }]
});
</script>
</body>
</html>