<?php
require_once 'vendor/autoload.php';
require getenv("ROOT")."/database/ChatHelper.php";

use PHPUnit\Framework\TestCase;
class ChatTest extends TestCase
{
    public function testGetMessageByID(){
        $messages =  ChatHelper::getMessagesByUserId(30);
        print_r($messages);
    }
}