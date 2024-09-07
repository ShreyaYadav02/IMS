<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - IMS</title>
    <link rel="stylesheet" href="./css/dashboard.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
</head>
<body>
    <div id="mainContainer">
    <?php include('partials/app-sidebar.php') ?>

        <div class="dashboard_container" id="dashboard_container">
        <?php include('partials/app-topnav.php') ?>

            <div class="rerportsContainer">
                <div class="box">
                    <div class="reportType">
                        <p>Export Products</p>
                        <div style="text-align: right;">
                            <a href="database/report_csv.php?report=product" class="reportExportBtn">Excel</a>
                            <a href="database/report_pdf.php?report=product" class="reportExportBtn">PDF</a>
                        </div>
                    </div>
                    <div class="reportType">
                        <p>Export Suppliers</p>
                        <div style="text-align: right;">
                            <a href="database/report_csv.php?report=supplier" class="reportExportBtn">Excel</a>
                            <a href="database/report-supplier_pdf.php?report=supplier" class="reportExportBtn">PDF</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="./js/script.js"></script>

</body>
</html>