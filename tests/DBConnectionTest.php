<?php

use PHPUnit\Framework\TestCase;

class DBConnectionTest extends TestCase
{
    public function testDBConnection(){

        $host = 'db';
        $db = 'db';
        $user = 'user';
        $password = 'password';

        $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

        try {
            $pdo = new PDO($dsn, $user, $password);
        
            if ($pdo) {
                print "connected";
            }
        } catch (PDOException $e) {
            print $e->getMessage();
        }

    }


}