<?php
use PHPUnit\Framework\TestCase;

require_once 'vendor/autoload.php';
require_once getenv("ROOT")."/database/PropertyHelper.php";
//require_once getenv("ROOT")."/database/UserHelper.php";


class PropertyTest extends TestCase
{
//$title, $description, $area, $price, $beds, $baths, $address, $lat, $long, $user_id
    public function testCreateProperty(){
        $faker = Faker\Factory::create();

//        SELECT MAX(id) FROM table
        $last_user_id = UserHelper::getLastUserId();
        $property =  PropertyHelper::createProperty(
        $faker->title(),
        $faker->imageUrl(),
        $faker->text(),
        $faker->numberBetween(1000, 2000),
        $faker->numberBetween(10000, 2000000),
        $faker->numberBetween(1, 10),
        $faker->numberBetween(1, 10),
        $faker->address(),
        $faker->latitude(),
        $faker->longitude(),
            $last_user_id['user_id']
        );

        $this->assertIsBool($property, true);
    }


    public function testGetAllUser(){
        $this->testCreateProperty();
        $properties = PropertyHelper::getAllProperty();
        $this->assertNotCount(0, $properties);
    }

}