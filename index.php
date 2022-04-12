<?php
session_start();
require_once("global_constants.php");
require_once("database/UserHelper.php");
include_once("views/components/header/header.php");

// home page

$users = UserHelper::getAllUsers();


//if ($users) {
//    foreach ($users as $user) {
//        echo $user['email'] . "<br/>";
//    }
//}
//echo Session::getLoggedInUsername();


include_once("views/components/body/homepage.php");

include_once("views/components/map/google_map_api.php");

include_once("views/components/footer/footer.php");
?>
