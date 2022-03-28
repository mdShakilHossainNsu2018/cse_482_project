<?php
require_once getenv("ROOT")."database/UserHelper.php";
?>

<link rel="stylesheet" href='<?php
echo SITE_URL ?>views/components/header/style.css'>

<script src="https://kit.fontawesome.com/a076d05399.js"></script>

<div class="main-nav">
    <nav>
        <a href="/"><div class="logo">Property Buy & Sell</div></a>
        <input type="checkbox" id="click">
        <label for="click" class="menu-btn">
            <i class="fas fa-bars"></i>

        </label>
        <ul>
            <li><a class="active" href="#">Home</a></li>
            <li><a href="#">Buy Property</a></li>
            <?php

            if (Session::isAuthenticated()){

                echo '<li><a href="'. SITE_URL .'views/auth/logout.php">Logout</a></li>';
              //  echo '<li style="color: #DDDDDD;">'.Session::getLoggedInUsername().'</li>';

                echo '<li><a href="#">Profile</a></li>';
            } else{
                echo '<li><a href="'.SITE_URL.'views/auth/auth.php">Login</a></li>';
            }

            ?>
        </ul>
    </nav>
</div>

