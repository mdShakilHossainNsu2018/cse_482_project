<?php
if (session_status() === PHP_SESSION_NONE) {
session_start();
}
require_once getenv("ROOT")."database/UserHelper.php";

?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">

        <a style="font-size:30px" href="/" class="navbar-brand">Property Buy & Sell </a> 
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" style="font-size:20px" href="">Home</a>
                </li>

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li> -->
                <!-- <li class="nav-item">
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                </li> -->

                          <?php

            if (Session::isAuthenticated()){

                $is_admin = Session::isAdmin();



                echo '<li class="nav-item"><a class="nav-link" style="font-size:20px" href="' . SITE_URL . 'views/add_property/add_property.php">Add Property</a></li>';


                echo '<li class="nav-item"><a class="nav-link" style="font-size:20px" href="'. SITE_URL .'views/auth/logout.php">Logout</a></li>';

                //  echo '<li style="color: #DDDDDD;">'.Session::getLoggedInUsername().'</li>';
                if ($is_admin){
                    echo '<li class="nav-item"><a class="nav-link" style="font-size:20px" href="'. SITE_URL .'views/chat/admin_chat.php">Admin Message</a></li>';
                } else{
                    echo '<li class="nav-item"><a class="nav-link" style="font-size:20px" href="'. SITE_URL .'views/chat/chat.php">Message</a></li>';
                }

                echo '<li class="nav-item"><a class="nav-link" style="font-size:20px" href="'. SITE_URL .'views/profile/profile.php">Profile</a></li>';
            } else{
                echo '<li id="signInBtn" class="nav-item"><a class="nav-link" style="font-size:20px" href="'.SITE_URL.'views/auth/auth.php">Login</a></li>';
            }

            ?>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" id="search" type="search" placeholder="Search" style="font-size:20px" aria-label="Search">

                <button class="btn btn-outline-success" style="font-size:20px" type="submit">Search</button>
            </form>

                <div class="list-group" style="position: fixed; right: 9rem; top: 5.5rem;">
                </div>

        </div>
    </div>
</nav>

<!---->
<!--<link rel="stylesheet" href='--><?php
//echo SITE_URL ?><!--views/components/header/style.css'>-->
<!---->
<!---->
<!---->
<!---->
<!--<div class="main-nav">-->
<!--    <nav>-->
<!--        <a href="/"><div class="logo">Property Buy & Sell</div></a>-->
<!--        <input type="checkbox" id="click">-->
<!--        <label for="click" class="menu-btn">-->
<!--            <i class="fas fa-bars"></i>-->
<!---->
<!--        </label>-->
<!--        <ul>-->
<!--            <li><a class="active" href="#">Home</a></li>-->
<!--            <li><a href="#">Buy Property</a></li>-->
<!--            --><?php
//
//            if (Session::isAuthenticated()){
//
//                echo '<li><a href="'. SITE_URL .'views/auth/logout.php">Logout</a></li>';
//              //  echo '<li style="color: #DDDDDD;">'.Session::getLoggedInUsername().'</li>';
//
//                echo '<li><a href="#">Profile</a></li>';
//            } else{
//                echo '<li><a href="'.SITE_URL.'views/auth/auth.php">Login</a></li>';
//            }
//
//            ?>
<!--        </ul>-->
<!--    </nav>-->
<!--</div>-->
<!---->

<script src="<?php echo SITE_URL.'views/components/header/ajax.js'?>"></script>
