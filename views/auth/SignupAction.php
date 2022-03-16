<?php
require "../../database/UserHelper.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['password']) && isset($_POST["name"]) && isset($_POST["email"])){
        if(UserHelper::createUser($_POST["name"], $_POST["email"], $_POST['password'])){
            echo "Success fully created account";
        };
    }
}

