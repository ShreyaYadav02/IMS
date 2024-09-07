<?php

    $data = $_POST;
    $user_id = (int) $data['user_Id'];
    $first_name = $data['f_name'];
    $last_name = $data['l_name'];
    $email = $data['email'];

    try{
        $sql->"UPDATE users SET email=?, first_name=?, last_name=?, uapdated_on=? WHERE id=?";
        include('connection.php');
        $pdo->prepare($sql)-> execute([$email, $first_name, $last_name, NOW(), $user_id, ]);


        $conn->exec($command);

        echo json_encode([
            'success' => true,
            'message' => 'User successfully deleted'
        ]);        
        } catch (PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error processing your request!'
        ]);   
    }