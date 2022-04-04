<?php
require_once(getenv("ROOT")."Session.php");
require("create_connection.php");
require_once(getenv("ROOT")."global_constants.php");


class PropertyHelper{

    public static function getLastId($idKey, $table){
        $db_conn = Database::getConnection();
        $last_id_stem = $db_conn->prepare("SELECT MAX($idKey) FROM $table");
        $last_id_stem->execute();
        return $last_id_stem->fetch()[0];
    }

    public static function createProperty($title, $description, $area, $price, $beds, $baths, $address, $lat, $leng): bool
    {
        $db_conn = Database::getConnection();

        $coords_sql = "INSERT INTO coords (idcoords, lat, lang) VALUES (?,?,?)";
        $coords_stmt = $db_conn->prepare($coords_sql);
        $coords_stmt->execute(array(
            self::getLastId("idcoords", "coords") == null ? 1 : self::getLastId("idcoords", "coords") + 1,
            $lat,
            $leng
        ));

        $sql = "INSERT INTO property_info 
                        (idProperty,
                           Location,
                           price,
                           users_iduser,
                           users_user_profile_idprofile,
                           details_idDetails) VALUES (?, ?, ?, ?, ?, ?);";

        $stmt = $db_conn->prepare($sql);

        return $stmt->execute(

            array(self::getLastId("idProperty", "property_info") == null ? 1 : self::getLastId("idcoords", "coords") + 1,

            $address, $price, 1, 1, ));
    }
}