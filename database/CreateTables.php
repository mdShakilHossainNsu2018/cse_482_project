<?php
require("connection.php");

class CreateTables{

    static public function createUserTable(){
        try {
            $sql = file_get_contents(getcwd().'/database/sql/create_tables.sql');
            $db_conn = Database::getConnection();
            $qr = $db_conn->exec($sql);
            echo "User table Successfully Created\n";
        } catch (PDOException $e){
            echo "User table Creation Error\n";
            print $e->getMessage();
        }
    }
}

