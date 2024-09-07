<?php
    $data = $_POST;
    $user_id = (int) $data['user_id'];

    try{
        $command = "DELETE FROM users WHERE id={$user_id}";

    include('connection.php');

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