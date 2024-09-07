<?php
    //start the session
    session_start();
    //capture the table mappings.
    include('table-columns.php');


    //Capture the table name
    $table_name = $_SESSION['table'];
    $columns = $table_columns_mapping[$table_name];


    //loop through the columns
    $db_arr = [];
    $user = $_SESSION['user'];
    foreach($columns as $column){
        if(in_array($column, ['created_on', 'updated_on'])) $value = date('Y-m-d H:i:s');
        else if ($column == 'created_by') $value = $user['id'];
        else if ($column == 'password') $value = password_hash($_POST[$column], PASSWORD_DEFAULT);
        else if ($column == 'img') {
            //upload or move the file to our directory
            $target_dir = "../uploads/products/";
            $file_data = $_FILES[$column];

            $file_name = $file_data['name'];
            $file_ext = pathinfo($file_name, PATHINFO_EXTENSION);
            $file_name = 'product-' . time() . '.' . $file_ext;

            $check = getimagesize($file_data['tmp_name']);
            
            //move the file
            if($check){
                if(move_uploaded_file($file_data['tmp_name'], $target_dir . $file_name)){
                    //save the file name to the database
                    $value = $file_name;
                }
            } else {
                //do not move the file
            }
        } 
        else $value = isset($_POST[$column]) ? $_POST[$column] : '';

        $db_arr[$column] = $value;
    }

    $table_properties = implode(", ", array_keys($db_arr));
    $table_placeholders = ':' . implode(",:", array_keys($db_arr));


    //Adding the record to main table
    try{
        $sql = "INSERT INTO 
                        $table_name($table_properties)
                    VALUES ($table_placeholders)";

    include('connection.php');

    $stmt = $conn->prepare($sql);
    $stmt->execute($db_arr);
    //Get saved id
    $product_id = $conn->lastInsertId();

    //Add supplier
    if($table_name === 'products'){
        $suppliers = isset($_POST['suppliers']) ? $_POST['suppliers'] : [];
        if($suppliers){
            //loop through the suppliers and add record
            foreach($suppliers as $supplier){
                $supplier_data = [
                    'supplier_id' => $supplier,
                    'product_id' => $product_id,
                    'created_on' => date('Y-m-d H:i:s'),
                    'updated_on' => date('Y-m-d H:i:s')

                ];

                $sql = "INSERT INTO productsuppliers
                            (supplier, product, created_on, updated_on) 
                        VALUES 
                            (:supplier_id, :product_id, :created_on, :updated_on)";
                $stmt = $conn->prepare($sql);
                $stmt->execute($supplier_data);
            }
        }
    }

        $response = [
        'success' => true,
        'message' => 'Successfully added to the system.'
    ];
    } catch (PDOException $e){
        $response = [
            'success' => false,
            'message' => $e->getMessage()
        ];
    }
    
    $_SESSION['response'] = $response;
    header('location: ../'  .$_SESSION['redirect_to']);

?>