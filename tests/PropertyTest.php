<?php
use PHPUnit\Framework\TestCase;

require_once 'vendor/autoload.php';
require getenv("ROOT")."/database/PropertyHelper.php";


class PropertyTest extends TestCase
{
//$title, $description, $area, $price, $beds, $baths, $address, $lat, $long, $user_id
    public function testCreateProperty(){
        $faker = Faker\Factory::create();

        $property =  PropertyHelper::createProperty(
        $faker->title(),
        $faker->text(),
        $faker->numberBetween(1000, 2000),
        $faker->numberBetween(10000, 2000000),
        $faker->numberBetween(1, 10),
        $faker->numberBetween(1, 10),
        $faker->address(),
        $faker->latitude(),
        $faker->longitude(),
        1
        );

        $this->assertIsBool($property, true);
    }

}