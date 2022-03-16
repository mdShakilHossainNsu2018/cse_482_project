<?php
require(getenv("ROOT")."global_constants.php");
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

include "views/components/footer/footer.php";
?>
