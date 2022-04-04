<?php
require_once(getenv("ROOT")."Session.php");
require_once("create_connection.php");
require_once(getenv("ROOT")."global_constants.php");


class PropertyHelper{

//    public static function getLastId($idKey, $table){
//        $db_conn = Database::getConnection();
//        $last_id_stem = $db_conn->prepare("SELECT MAX($idKey) FROM $table");
//        $last_id_stem->execute();
//        return $last_id_stem->fetch()[0];
//    }


    public static function createProperty($title, $description, $area, $price, $beds, $baths, $address, $lat, $long, $user_id): bool
    {
        $db_conn = Database::getConnection();

        $sql = "INSERT INTO properties 
                        (title,
                         address,
                         price,
                         area,
                         beds,
                         baths,
                         details,
                         users_user_id
                      ) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stmt = $db_conn->prepare($sql);
        if ($stmt->execute(
            array( $title, $address, $price,
                $area, $beds, $baths, $description,
                 $user_id
            ))){
            $last_property_id = $db_conn->lastInsertId();
            $coords_sql = "INSERT INTO coords ( lat, `long`, properties_property_id) VALUES (?,?, ?)";
            $coords_stmt = $db_conn->prepare($coords_sql);
            return $coords_stmt->execute(array(
                $lat,
                $long,
                $last_property_id
            ));
        }
        return false;
    }
}