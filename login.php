<?php
    //Start the session.
    session_start();
    if(isset($_SESSION['user'])) header('location: dashboard.php');
    
    $error_message = '';

    if($_POST){
       include('./database/connection.php');

       $username = $_POST['username'];
       $password = $_POST['password'];

       $query = 'SELECT * FROM users WHERE users.email="'. $username .'" AND users.password="'. $password .'"';
       $stmt = $conn->prepare($query);
       $stmt->execute();

       if($stmt->rowCount() > 0){
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetchALL()[0];

        //Captures data of currently login users.
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
       } else $error_message = 'Please make sure the username and password are correct.';
       
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management System</title>
    
    <link rel="stylesheet" href="./css/login.css">
</head>
<body id="loginBody">
    <?php if(!empty($error_message)) { ?>
    
        <div id="errorMessage" style="background: #fff;  text-align: center;   color: red;   font-size: 15px;   padding: 5px;">
            <strong>ERROR: </strong> <p><?= $error_message?></p>
    </div>
    <?php } ?>
    <div class="container">
        <div class="header">
            <h1>IMS</h1>
            <h3>Inventory Management System</h3>
        </div>
        <div class="loginBody">
            <form action="login.php" method="POST">
                <div class="loginInput" >
                    <label for="">Username</label>
                    <input placeholder="username" name="username" type="text" />
                </div>
                <div class="loginInput">
                    <label for="">Password</label>
                    <input placeholder="password" name="password" type="password" />
                </div>
                <div class="loginButton">
                    <button>Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>