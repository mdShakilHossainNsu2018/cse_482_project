<?php
require_once(getenv("ROOT")."Session.php");
require("create_connection.php");
require_once(getenv("ROOT")."global_constants.php");


class PropertyHelper{
    function createProperty($title, $description, $price, $beds, $baths, $address, $lat, $leng){
        $db_conn = Database::getConnection();

        $sql = "INSERT INTO property_info (idProperty, Location, price, users_iduser, users_user_profile_idprofile, details_idDetails) VALUES (?, ?, ?);";
        $stmt = $db_conn->prepare($sql);
        $password = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute(array($username, $email, $password));
    }
}