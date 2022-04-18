<?php

use PHPUnit\Framework\TestCase;

require_once 'vendor/autoload.php';
require_once getenv("ROOT")."/database/UserHelper.php";

class UserTest extends TestCase
{
    public function testUserCreate()
    {
        $faker = Faker\Factory::create();

        $user = UserHelper::createUser($faker->name(), $faker->email(), $faker->password());

        $this->assertIsBool($user, true);
    }
}