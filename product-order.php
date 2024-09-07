<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');

    //Get all products
    $show_table = 'products';
    $products = include('database/show.php');
    $products = json_encode($products);
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Products - IMS</title>

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
                        <h1 class="section_header">Order Product</h1>
                            <div>
                                <div class="alignRight">
                                    <button class="orderProductBtn" id="orderProductBtn">New Product Order</button>
                                </div>
                                <div id="orderProductLists">
                                    
                                </div>
                                <div class="alignRight" style="margin-top: 20px;">
                                    <button class="orderProductBtn">Place Order</button>
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
    var products = <?= $products ?>;
    var counter = 0;

    function script(){
        var vm = this;

        let productOptions = '\
            <div>\
                <label for="product_name">Product Name</label>\
                    <select name="product_name" class="productNameSelect" id="product_name">\
                    <option value="">Select Product</option>\
                    <option value="">haircare</option>\
                    <option value="">skincare</option>\
                    <option value="">camera</option>\
                </select>\
                <button class="removeOrderBtn">Remove</button>\
            </div>';

        

        this.initialize = function(){
            this.registerEvents();
            this.renderProductOptions();
        },

        this.renderProductOptions = function(){
            let optionHtml = '';
            products.forEach((product) => {
                optionHtml == '<option value="' + product.id + '">' + product.product_name +'</option>';
            })

            productOptions = productOptions.replace('INSERTPRODUCTHERE', optionHtml);
        },

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;//target element               
                classList = targetElement.classList;


                //add new product event
                if(targetElement.id === 'orderProductBtn'){
                    let orderProductListsContainer = document.getElementById('orderProductLists');

                    orderProductLists.innerHTML += '\
                        <div class="orderProductRow">\
                            '+ productOptions +'\
                            <div class="suppliersRows" id="supplierRows_'+counter+'"data-counter="'+counter+'"></div>\
                        </div>';
                    counter++;    
                } 

                //if remove button is clicked
                if(targetElement.classList.contains('removeOrderBtn')){
                    let OrderRow = targetElement
                        .closest('div.orderProductRow')

                    //remove element
                    orderRow.remove();
                }
            });

            document.addEventListener('change', function(e){
                targetElement = e.target;//target element               
                classList = targetElement.classList;


                //add suppliers row on product option change
                if(classList.contains('productNameSelect')){
                    let pid = targetElement.value;

                    let counterId = targetElement
                        .closest('div.orderProductRow')
                        .querySelector('supplierRows')
                        .dataset.counter;                    

                    $.get('database/get-product-supplier.php', {id:pid}, function(suppliers){
                        vm.renderSupplierRows(suppliers, counterId);
                    }, 'json');
                }
            });
        },
        this.renderSupplierRows = function(suppliers, counterId){
            let supplierRows = '';
            suppliers.forEach((supplier) => {
                supplierRows += '\
                    <div class="orderRow">\
                        <div style="width: 30%;">\
                            <p class="supplierName">supplier.supplier_name</p>\
                        </div>\
                        <div style="width: 30%; padding-left: 40px;">\
                            <label for="quantity">Quantity: </label>\
                            <input type="number" class="appFormInput" id="quantity" placeholder="Enter quantity" name="quantity"/>\
                        </div>\
                    </div>';
            });
            
            //Append the container
            let supplierRowContainer = document.getElementById('supplierRows_' + counterId);
            supplierRowContainer.innerHTML = supplierRows;
        }
    }
    (new script()).initialize();
</script>
</body>
</html>