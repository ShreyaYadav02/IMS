<?php
    $type = $_GET['report'];
    $file_name = '.xlsx';

    $mapping_filenames = [
        'supplier' => 'Supplier Report',
        'product' => 'Product Report'
    ];

    $file_name = $mapping_filenames[$type] . '.xls';
    header("Content-Disposition: attachment; filename=\"$\"");
    header("Content-Type: application/vnd.ms-excel");

    //pull data from database.
    include('connection.php');

    //Product Export
    if($type === 'product'){
        $stmt = $conn->prepare("SELECT * FROM products INNER JOIN users ON products.created_by = users.id ORDER BY products.created_on DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $products = $stmt->fetchAll();

        //header
        // 
        $is_header = true;
        foreach($products as $product){
            $product['created_by'] = $product['first_name'] . ' ' . $product['last_name'];
            unset($product['first_name'], $product['last_name'], $product['password'], $product['email']);
            if($is_header){
                $row = array_keys($product);
                $is_header = false;
                echo implode("\t", $row) . "\n";
            }

            //detect double quotes and escape any value that contains them
            array_walk($product, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });
            echo implode("\t", $product) . "\n";

        }
    }

    //Supplier Export
    if($type === 'supplier'){
        $stmt = $conn->prepare("SELECT suppliers.id as spid, suppliers.created_on as screatedon, users.first_name, users.last_name,
        suppliers.supplier_location, suppliers.email, suppliers.created_by FROM suppliers INNER JOIN users ON suppliers.created_by = users.id ORDER BY suppliers.created_on DESC");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        $suppliers = $stmt->fetchAll();

        //header
        $is_header = true;
        foreach($suppliers as $supplier){
            $supplier['created_by'] = $supplier['first_name'] . ' ' . $supplier['last_name'];
            unset($supplier['first_name'], $supplier['last_name']);

            if($is_header){
                $row = array_keys($supplier);
                $is_header = false;
                echo implode("\t", $row) . "\n";
            }

            //detect double quotes and escape any value that contains them
            array_walk($supplier, function(&$str){
                $str = preg_replace("/\t/", "\\t", $str);
                $str = preg_replace("/\r?\n/", "\\n", $str);
                if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
            });
            echo implode("\t", $supplier) . "\n";

        }
    }