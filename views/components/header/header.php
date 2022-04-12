<?php
require_once getenv("ROOT")."database/UserHelper.php";
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.slim.min.js" integrity="sha256-u7e5khyithlIdTpu22PHhENmPcRdFiHRjhAuHcs05RI=" crossorigin="anonymous"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container-fluid">

        <a href="/" class="navbar-brand">Property Buy & Sell</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="">Home</a>
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
                          echo '<li class="nav-item"><a class="nav-link" href="' . SITE_URL . 'views/chat/chat.php">Message</a></li>';

            if (Session::isAuthenticated()){

                echo '<li class="nav-item"><a class="nav-link" href="' . SITE_URL . 'views/add_property/add_property.php">Add Property</a></li>';


                echo '<li class="nav-item"><a class="nav-link" href="'. SITE_URL .'views/auth/logout.php">Logout</a></li>';
                //  echo '<li style="color: #DDDDDD;">'.Session::getLoggedInUsername().'</li>';

                echo '<li class="nav-item"><a class="nav-link" href="#">Profile</a></li>';
            } else{
                echo '<li class="nav-item" id="signInBtn"><a class="nav-link" href="'.SITE_URL.'views/auth/auth.php">Login</a></li>';
            }

            ?>

            </ul>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
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
