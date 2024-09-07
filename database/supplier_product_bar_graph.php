<?php

include('connection.php');

//Query suppliers
$stmt = $conn->prepare("SELECT id, supplier_name FROM suppliers");
$stmt->execute();
$rows = $stmt->fetchAll();

$categories = [];
$bar_chart_data = [];

$colors = ['#FF0000', '#0000FF', '#ADD8E6', '#800080', '#00FF00', '#FF00FF', '#FFA500'];

$counter = 0;

//Query supplier product count
foreach($rows as $key => $row){
    $id = $row['id'];

    $categories[] = $row['supplier_name'];

    //query count
    $stmt = $conn->prepare("SELECT COUNT(*) as p_count FROM productsuppliers WHERE productsuppliers.supplier='" .$id. "'");
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['p_count'];

    if(!isset($colors[$key])) $counter=0;

    $bar_chart_data[] = [
        'y' => (int) $count,
        'color' => $colors[$counter]
    ];
    $counter++;    
}
/*die;

var_dump($rows);
die;

$results = [];

//Loop through statuses and query
foreach($statususes as $status){
    $stmt = $conn->prepare("SELECT COUNT(*) as status_count FROM order_product WHERE order_product.status='" . 
    $status . "'");
    $stmt->execute();
    $row = $stmt->fetch();

    $count = $row['status_count'];

    $results[] = [
        'name' => strtoupper($status),
        'y' => (int) $count
    ];
}*/