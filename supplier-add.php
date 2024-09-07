<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    
    $_SESSION['table'] = 'suppliers';
    $_SESSION['redirect_to'] = 'supplier-add.php';

    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Supplier - IMS</title>

    <?php include('partials/app-header-scripts.php'); ?>

</head>
<body>
    <div id="mainContainer">
        <?php include('partials/app-sidebar.php') ?>
        <div class="dashboard_container" id="dashboard_container">
            <?php include('partials/app-topnav.php') ?>
        <div class="content">

            <div class="main">
                <div class="row">
                    <div class="column column-12">
                        <h1 class="section_header">New Supplier</h1>
                            <div id="userAddFromContainer">
                                <form action="database/add.php" method="POST" class="appForm" enctype="multipart/form-data" id="userAddForm">
                                <div>
                                    <label for="supplier_name">Supplier Name</label>
                                    <input type="text" class="appFormInput" id="supplier_name" placeholder="Enter Supplier name" name="supplier_name"/>
                                </div>
                                <div>
                                    <label for="supplier_location">Location</label>
                                    <input type="text" class="appFormInput" placeholder="Enter product supplier location..." id="supplier_location"  name="supplier_location">
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" class="appFormInput" placeholder="Enter product supplier email..." id="email"  name="email">

                                </div>
                                
                                <button type="submit" class="appBtn"><i class="fa-solid fa-plus"></i> Add Supplier</button>
                                </form>
                                <?php 
                                if(isset($_SESSION['response'])){ 
                                    $response_message = $_SESSION['response']['message'];
                                    $is_success = $_SESSION['response']['success'];
                                ?>
                                <div class="responseMessage">
                                    <p class=" responseMessage <?= $is_success ? 'responseMessage_success' : 'responseMessage_error' ?>">
                                        <?= $response_message ?>
                                    </p>
                                </div>    
                                <?php unset($_SESSION['response']); } ?>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php include('partials/app-scripts.php'); ?>
</body>
</html>