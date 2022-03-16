<?php
require(getenv("ROOT")."global_constants.php");
require ("database/create_connection.php");

include "views/components/header/header.php";

// home page

$db = Database::getConnection();
$stmt = $db->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();

if ($users) {
    foreach ($users as $user) {
        echo $user['email'] . "<br/>";
    }
}

echo "<h1> Hello world changed </h1>";

include "views/components/footer/footer.php";
?>
