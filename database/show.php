<?php
include('connection.php');

$table_name = $show_table;

    $stmt = $conn->prepare("SELECT * FROM $table_name ORDER BY created_on DESC");
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    return $stmt->fetchAll();
    