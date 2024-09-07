<?php
    //Start the session
    session_start();
    if(!isset($_SESSION['user'])) header('location: login.php');
    $_SESSION['table'] = 'users';
    $user = $_SESSION['user'];

    $show_table = 'users';
    $users = include('database/show.php');
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View-Users - IMS</title>
   
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
                        <h1 class="section_header"><i class="fa-solid fa-list"></i> List of Users</h1>
                        <div class="section_content">
                            <div class="users">
                                <p class="usercount"><?= count($users) ?> Users</p>
                                <table>
                                    <thead>
                                       <tr>
                                       <th>#</th> 
                                       <th>First Name</th> 
                                       <th>Last Name</th> 
                                       <th>Email</th> 
                                       <th>Created On</th> 
                                       <th>Updated On</th>
                                       <th>Action</th>
                                       </tr> 
                                    </thead>
                                    <tbody>
                                        <?php foreach($users as $index => $user){ ?>
                                            <tr>                                            
                                            <td><?= $index + 1 ?></td>
                                            <td class="firstName"><?= $user['first_name'] ?></td>
                                            <td class="lastName"><?= $user['last_name'] ?></td>
                                            <td class="email"><?= $user['email'] ?></td>
                                            <td><?= date('F d,Y', strtotime($user['created_on'])) ?></td>
                                            <td><?= date('F d,Y', strtotime($user['updated_on'])) ?></td>
                                            <td>
                                                <a href="" class="deleteUser" data-userid="<?= $user['id']?>" data-fname="<?= $user['first_name'] ?>" 
                                                data-lname="<?= $user['last_name'] ?>"><i class="fa-solid fa-trash"></i></i>Delete</a>
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

        this.initialize = function(){
            this.registerEvents();
        },

        this.registerEvents = function(){
            document.addEventListener('click', function(e){
                targetElement = e.target;               
                classList = targetElement.classList;

                if(classList.contains('deleteUser')){
                    e.preventDefault();
                    userId = targetElement.dataset.userid;
                    fname = targetElement.dataset.fname;
                    lname = targetElement.dataset.lname;
                    fullName = fname + ' ' + lname;

                    if(window.confirm('Are you sure you want to delete '+ fullName +'?')){
                        $.ajax({
                            method: 'POST',
                            data: {
                                user_id : userId
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

                if(classList.contains('updateUser')){
                    e.preventDefault();

                    //get data
                    firstName = targetElement.closest('tr').querySelector('td.firstName');
                    lastName = targetElement.closest('tr').querySelector('td.lastName');
                    email = targetElement.closest('tr').querySelector('td.email');
                    userId = targetElement.dataset.userid;

                    BootstrapDialog.confirm({
                        title: 'Update ' + fistName + ' ' + lastName,
                        message: '<form>\
                        <div class="form-group">\
                        <label for="firstName">First Name:</label>\
                        <input type="text" class="form-control" id="firstName" value="'+ firstName +'">\
                        </div>\
                        <div class="form-group">\
                        <label for="lastName">Last Name:</label>\
                        <input type="text" class="form-control" id="lastName" value="'+ lastName +'">\
                        </div>\
                        <div class="form-group">\
                        <label for="email">Email address:</label>\
                        <input type="email" class="form-control" id="emailUpdate" value="'+ email +'">\
                        </div>\
                        </form>'
                        callback: function(isUpdate){
                            if(isUpdate){
                                $.ajax({
                                    method: 'POST',
                                    data: {
                                        user_id : userId,
                                        f_name: document.getElementById('firstName').value,
                                        l_name: document.getElementById('lastName').value,
                                        email: document.getElementById('emailUpdate').value
                                },
                                url: './database/update-user.php',
                                dataType: 'json',
                                success: function(data){
                                    if(data.success){
                                        BootstrapDialog.alert({
                                            type: BootstrapDialog.TYPE_SUCCESS,
                                            message: data.message,
                                            callback: function(){
                                                location.reload();
                                            }
                                        });
                                    } else 
                                    BootstrapDialog.alert({
                                        type: BootstrapDialog.TYPE_SUCCESS,
                                        message: data.message,

                                    });    
                            }
                            
                        })
                            }
                        }
                    });
                }
            });
        }
    }

    var script = new script;
    script.initialize();
</script>
</body>
</html>