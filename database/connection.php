<?php
class Database {


    private static $db;
    private $db_connection;


    private function __construct() {
        try {
            $this->db_connection = new PDO("mysql:host=db;dbname=db;charset=UTF8", "user", "password");
            $this->db_connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            print $e->getMessage();
        }
    }

    function __destruct() {
        $this->db_connection = null;
    }

    public static function getConnection(): PDO
    {
        if (self::$db == null) {
            self::$db = new Database();
        }
        return self::$db->db_connection;
    }
}
?>

