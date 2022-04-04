<?php
class Session
{

    public static function setSession($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function getSession($key){
        return $_SESSION[$key];
    }

    public static function isAuthenticated(): bool {
        return (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true);
    }

    public static function getLoggedInUsername(){
        if(self::isAuthenticated()){
            return $_SESSION["username"];
        }
        return null;
    }

    public static function getLoggedInUserId(){
        if(self::isAuthenticated()){
            return $_SESSION["user_id"];
        }
        return null;
    }

}