<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    
    $show_table = 'products';
    $products = include('database/show.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-Products - IMS</title>
    
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
                        <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Products</h1>
                        <div class="section_content">
                            <div class="users">
                            <p class="userCount" style="text-align: right; font-weight: bold; text-transform: uppercase;"><?= count($products) ?> Products</p>
                            <table>
                                    <thead>
                                       <tr>
                                       <th>#</th>
                                       <th>Image</th>
                                       <th>Product Name</th> 
                                       <th>Description</th>
                                       <th>Created By</th> 
                                       <th>Created On</th> 
                                       <th>Updated On</th>
                                       <th>Action</th>
                                       </tr> 
                                    </thead>
                                    <tbody>
                                        <?php foreach($products as $index => $product){ ?>
                                            <tr>                                            
                                            <td><?= $index + 1 ?></td>
                                            <td class="firstName">
                                                <img class="productImages" src="uploads/products/<?= $product['img'] ?>" alt="" />
                                            </td>
                                            <td class="lastName"><?= $product['product_name'] ?></td>
                                            <td class="email"><?= $product['description'] ?></td>
                                            
                                            <td><?= $product['created_by'] ?></td>
                                            <td><?= date('F d,Y', strtotime($product['created_on'])) ?></td>
                                            <td><?= date('F d,Y', strtotime($product['updated_on'])) ?></td>
                                            <td>
                                                <a href="" class="updateProduct" data-pid="<?= $product['id'] ?>"> <i class="fa-solid fa-pencil"></i>Edit</a>
                                                <a href="" class="deleteProduct" data-name="<?= $product['product_name'] ?>" data-pid="<?= $product['id'] ?>"> <i class="fa-solid fa-trash"></i></i>Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        </div>
    </div>
<?php include('partials/app-scripts.php'); ?>
<script>
    function script(){

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;               
                classList = targetElement.classList;

                if(classList.contains('deleteProduct')){
                    e.preventDefault();

                    pId = targetElement.dataset.pid;
                    pName = targetElement.dataset.name;

                    if(window.confirm('Are you sure you want to delete '+ pName +'?')){

                        $.ajax({
                            method: 'POST',
                            data: {
                                id : pId,
                                table: 'products'
                            },
                            url: './database/delete.php',
                            dataType: 'json',
                            success: function(data){
                                if(data.success){
                                    if(window.confirm(data.message)){
                                        location.reload();
                                    }
                                } else { window.alert(data.message);
                                }
                            }
                        })
                    
                    } else {
                        console.log('will not delete');
                    }
                }
            });
        }

        this.initialize = function(){
            this.registerEvents();
        }
    }
    var script = new script;
    script.initialize();
</script>
</body>
</html>