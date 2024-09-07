<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'users';
    $_SESSION['redirect_to'] = 'users-add.php';

    $show_table = 'users';
    $users = include('database/show.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User - IMS</title>
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
                        <h1 class="section_header">New User</h1>
                            <div id="userAddFromContainer">
                                <form action="database/add.php" method="POST" class="appForm" id="userAddForm">
                                <div>
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="appFormInput" id="first_name" name="first_name"/>
                                </div>
                                <div>
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="appFormInput" id="last_name" name="last_name"/>
                                </div>
                                <div>
                                    <label for="email">Email</label>
                                    <input type="text" class="appFormInput" id="email" name="email"/>
                                </div>
                                <div>
                                   <label for="password">Password</label>
                                    <input type="password" class="appFormInput" id="password" name="password"/>
                                 </div>
                            
                                    <button type="submit" class="appBtn"><i class="fa-solid fa-user-plus"></i>Add User</button>
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