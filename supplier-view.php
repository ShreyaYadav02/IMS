<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    
    $show_table = 'suppliers';
    $suppliers = include('database/show.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-Suppliers - IMS</title>
    
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
                        <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Suppliers</h1>
                        <div class="section_content">
                            <div class="users">
                            <table>
                                    <thead>
                                       <tr>
                                       <th>#</th>
                                       <th>Supplier Name</th>
                                       <th>Supplier Location</th> 
                                       <th>Contact Details</th>
                                       <th>Created By</th> 
                                       <th>Created On</th> 
                                       <th>Updated On</th>
                                       <th>Action</th>
                                       </tr> 
                                    </thead>
                                    <tbody>
                                        <?php foreach($suppliers as $index => $supplier){ ?>
                                        <tr>                                            
                                            <td><?= $index + 1 ?></td>
                                            <td class="firstName">
                                                <?= $supplier['supplier_name'] ?>
                                            </td>
                                            <td><?= $supplier['supplier_location'] ?></td>
                                            <td><?= $supplier['email'] ?></td>
                                            
                                         
                                               
                                            <td><?= $supplier['created_by'] ?></td>
                                            <td><?= date('F d,Y', strtotime($supplier['created_on'])) ?></td>
                                            <td><?= date('F d,Y', strtotime($supplier['updated_on'])) ?></td>
                                            <td>
                                                <!--<a href="" class="updateProduct" data-pid="<?= $product['id'] ?>"> <i class="fa-solid fa-pencil"></i>Edit</a>-->
                                                <a href="" class="deleteSuppplier" data-name="<?= $supplier['supplier_name'] ?>" data-sid="<?= $supplier['id'] ?>"> <i class="fa-solid fa-trash"></i></i>Delete</a>
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

                if(classList.contains('deleteSuppplier')){
                    e.preventDefault();

                    sId = targetElement.dataset.sid;
                    sName = targetElement.dataset.name;

                    if(window.confirm('Are you sure you want to delete '+ sName +'?')){

                        $.ajax({
                            method: 'POST',
                            data: {
                                id : sId,
                                table: 'suppliers'
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