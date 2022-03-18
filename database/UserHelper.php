<?php

require("create_connection.php");

class UserHelper
{

    public static function getAllUsers(){
        $db_conn = Database::getConnection();
        $stmt = $db_conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function createUser($username, $email, $password ): bool
    {
        $db_conn = Database::getConnection();
        $sql = "INSERT INTO users ( username, email, password) VALUES (?, ?, ?);";
        $stmt = $db_conn->prepare($sql);
        return $stmt->execute(array($username, $email, $password));
    }

    public static function login($email, $password){


    }

    public static function isAuthenticated(): bool{

        return false;
    }
}