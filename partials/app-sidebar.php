<?php
    $user = $_SESSION['user'];
?>    

<div class="sidebar" id="sidebar">
    <h3 class="logo" id="logo">IMS</h3>
        <div class="user">
            <img src="./images/user_logo.jpg" alt="user image" id="userimage" />
            <span><?= $user['first_name'] . ' ' . $user['last_name'] ?></span>
        </div>
        <div class="menu">
            <ul class="menu_list">
                <!-- class="menuActive" -->
                <li class="liMainMenu">
                    <a href="./dashboard.php"><i class="fa-solid fa-compass "></i> <span class="menuText">Dashboard</span></a>
                </li>
                <li class="liMainMenu">
                    <a href="./report.php"><i class="fa-solid fa-file "></i> <span class="menuText">Reports</span></a>
                </li>
                <li class="liMainMenu">
                <a href="javascript:void(0);" class="showhideSubMenu" >
                        <i class="fa-solid fa-tag showhideSubMenu" ></i> 
                        <span class="menuText showhideSubMenu" >Product</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showhideSubMenu" ></i>
                    </a>

                    <ul class="subMenus" id="user">
                        <li><a class="subMenuLink" href="./product-view.php"><i class="fa-solid fa-circle"></i> View Products</a></li>
                        <li><a class="subMenuLink" href="./product-add.php"><i class="fa-solid fa-circle"></i> Add Products</a></li>
                        <li><a class="subMenuLink" href="./product-order.php"><i class="fa-solid fa-circle"></i> Order Products</a></li>
                    </ul>                
                <li class="liMainMenu">                    
                    <a href="javascript:void(0);" class="showhideSubMenu" >
                        <i class="fa-solid fa-truck showhideSubMenu" ></i> 
                        <span class="menuText showhideSubMenu" >Supplier</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showhideSubMenu" ></i>
                    </a>

                    <ul class="subMenus" id="user">
                        <li><a class="subMenuLink" href="./supplier-view.php"><i class="fa-solid fa-circle"></i> View Suppliers</a></li>
                        <li><a class="subMenuLink" href="./supplier-add.php"><i class="fa-solid fa-circle"></i> Add Suppliers</a></li>
                    </ul>
                </li>
                <li class="liMainMenu showhideSubMenu" >
                    <a href="javascript:void(0);" class="showhideSubMenu" >
                        <i class="fa-solid fa-user-plus showhideSubMenu" ></i> 
                        <span class="menuText showhideSubMenu" >User</span>
                        <i class="fa-solid fa-angle-down mainMenuIconArrow showhideSubMenu" ></i>
                    </a>

                    <ul class="subMenus" id="user">
                        <li><a class="subMenuLink" href="./users-view.php"><i class="fa-solid fa-circle"></i> View Users</a></li>
                        <li><a class="subMenuLink" href="./users-add.php"><i class="fa-solid fa-circle"></i> Add Users</a></li>
                    </ul>
                </li>  
            </ul>
    </div>
</div>