<?php
include('connection.php');

$id = $_GET['id'];

//fetch suppliers.
$stmt = $conn->prepare("
            SELECT supplier_name, suppliers.id
            FROM suppliers, productsuppliers
            WHERE
                productsuppliers.product=$id
                    AND
                productsuppliers.suppliers = suppliers.id
        ");
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($suppliers);