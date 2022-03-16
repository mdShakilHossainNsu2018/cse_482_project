<?php

require("create_connection.php");

class UserHelper
{
    public static function getAllUsers(){
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}