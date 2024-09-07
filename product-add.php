<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    
    $_SESSION['table'] = 'products';
    $_SESSION['redirect_to'] = 'product-add.php';

    $user = $_SESSION['user'];
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Products - IMS</title>

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
                        <h1 class="section_header">New Product</h1>
                            <div id="userAddFromContainer">
                                <form action="database/add.php" method="POST" class="appForm" enctype="multipart/form-data" id="userAddForm">
                                <div>
                                    <label for="product_name">Product Name</label>
                                    <input type="text" class="appFormInput" id="product_name" placeholder="Enter product name" name="product_name"/>
                                </div>
                                <div>
                                    <label for="description">Description</label>
                                    <textarea  class="appFormInput productTextArea" placeholder="Enter product description..." id="description"  name="description">
                                    </textarea>
                                </div>
                                <div>
                                    <label for="description">Suppliers</label>
                                    <select name="suppliers[]" id="suppliersSelect">
                                        <option value="">Select Supplier</option>
                                        <?php
                                        $show_table = 'suppliers';
                                        $suppliers = include('database/show.php');

                                        foreach($suppliers as $supplier){
                                            echo "<option value' ". $supplier['id'] . "'> ".$supplier['supplier_name'] ."</option>";
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div>
                                    <label for="product_name">Product Image</label>
                                    <input type="file" name="img"/>
                                </div>
                                <button type="submit" class="appBtn"><i class="fa-solid fa-plus"></i> Add Product</button>
                                </form>
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