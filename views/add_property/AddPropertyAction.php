<?php
require("../../database/PropertyHelper.php");

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $title = $_POST["title"];
    $description = $_POST["description"];
    $price = $_POST["price"];
    $beds = $_POST["beds"];
    $baths = $_POST["baths"];
    $address = $_POST["address"];
    $area = $_POST["area"];
    $lat = $_POST["lat"];
    $leng = $_POST["leng"];


    // $title, $description, $price, $beds, $baths, $address, $lat, $leng
    PropertyHelper::createProperty($title, $description, $area, $price, $beds, $baths, $address, $lat, $leng);


}