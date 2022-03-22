<?php
session_start();
require_once("global_constants.php");
require("database/UserHelper.php");
include "views/components/header/header.php";

// home page

$users = UserHelper::getAllUsers();


if ($users) {
    foreach ($users as $user) {
        echo $user['email'] . "<br/>";
    }
}


echo "<h1> Hello world changed </h1>";

//include_once "views/components/map/google_map_api.php";

include "views/components/footer/footer.php";
?>
