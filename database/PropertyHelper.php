<?php
require_once(getenv("ROOT") . "Session.php");
require_once("connection.php");
require_once(getenv("ROOT") . "global_constants.php");


class PropertyHelper
{

//    public static function getLastId($idKey, $table){
//        $db_conn = Database::getConnection();
//        $last_id_stem = $db_conn->prepare("SELECT MAX($idKey) FROM $table");
//        $last_id_stem->execute();
//        return $last_id_stem->fetch()[0];
//    }


    public static function createProperty($title,
                                          $image,
                                          $description,
                                          $area,
                                          $price,
                                          $beds,
                                          $baths,
                                          $address,
                                          $lat,
                                          $long,
                                          $user_id): bool
    {
        try {
            $db_conn = Database::getConnection();
        } catch (PDOException $exception) {
            echo "<h1>Error while connecting to database</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $sql = "INSERT INTO properties 
                        (title,
                         image,
                         address,
                         price,
                         area,
                         beds,
                         baths,
                         details,
                         users_user_id
                      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $stmt = $db_conn->prepare($sql);
            $stmt->execute(
                array($title, $image, $address, $price,
                    $area, $beds, $baths, $description,
                    $user_id
                ));

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }

        try {
            $last_property_id = $db_conn->lastInsertId();
            $coords_sql = "INSERT INTO coords ( lat, `long`, properties_property_id) VALUES (?,?, ?)";
            $coords_stmt = $db_conn->prepare($coords_sql);
            return $coords_stmt->execute(array(
                $lat,
                $long,
                $last_property_id
            ));

        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getAllCoords()
    {
        try {
            $db_conn = Database::getConnection();
        } catch (PDOException $exception) {
            echo "<h1>Error while connecting to database</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $sql = "SELECT coords_id, lat, `long`, address FROM coords join properties p on coords.properties_property_id = p.property_id;";
            $stmt = $db_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        return null;
    }

    public static function getCordByProperty($property_id)
    {

        $db_conn = Database::getConnection();

        try {
            $sql = "SELECT coords_id, lat, `long` FROM coords join properties p on coords.properties_property_id = p.property_id where p.property_id = ?;";
            $stmt = $db_conn->prepare($sql);
            $stmt->execute(array($property_id));
            return $stmt->fetch();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        }
        return null;
    }

    public static function getAllProperty()
    {
        try {
            $db_conn = Database::getConnection();
        } catch (PDOException $exception) {
            echo "<h1>Error while connecting to database</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $sql = "SELECT 
                        property_id,
                        title,
                        image,
                         address,
                        trim(leading '0' from price) as price,
                         area,
                         beds,
                         baths,
                         details,
                         users_user_id, created_at FROM properties";
            $stmt = $db_conn->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }

    public static function getPropertyBy($id)
    {

        $db_conn = Database::getConnection();

        try {
            $sql = "SELECT 
                        property_id,
                        title,
                        properties.image,
                         properties.address,
                        trim(leading '0' from price) as price,
                         area,
                         beds,
                         baths,
                         details,
                        up.name as name,
                        up.phone as phone,
                        u.email as email,
                         properties.users_user_id FROM properties join users u on u.user_id = properties.users_user_id join user_profile up on u.user_id = up.users_user_id where property_id=(?)";
            $stmt = $db_conn->prepare($sql);
            $stmt->execute(array($id));
            return $stmt->fetch();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
            return false;
        }
    }


}