<?php
require "../../database/UserHelper.php";
require_once "../../global_constants.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['password']) && isset($_POST["name"]) && isset($_POST["email"])){
        if(UserHelper::createUser($_POST["name"], $_POST["email"], $_POST['password'])){
            echo "<script>window.location.href = `".SITE_URL."index.php`</script>";

        };
    }
}

