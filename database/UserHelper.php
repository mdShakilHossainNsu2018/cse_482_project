<?php

require("create_connection.php");

class UserHelper
{
    private static $db;

    public function __construct()
    {
        self::$db = Database::getConnection();
    }

    public static function getAllUsers(){
        $stmt = self::$db->prepare("SELECT * FROM users");
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
}