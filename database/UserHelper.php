<?php
require_once(getenv("ROOT")."Session.php");
require("create_connection.php");
require_once(getenv("ROOT")."global_constants.php");


class UserHelper
{
    public static function getAllUsers(){
        $db_conn = Database::getConnection();
        $stmt = $db_conn->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public static function getLastId($idKey, $table){
        $db_conn = Database::getConnection();
        $last_id_stem = $db_conn->prepare("SELECT MAX($idKey) FROM $table");
        $last_id_stem->execute();
        return $last_id_stem->fetch()[0];
}

    public static function createUser($username, $email, $password ): bool
    {

        $db_conn = Database::getConnection();




        $sql_profile_create = "insert into user_profile (idprofile, number, address, name) VALUES (?, ?, ?, ?);";
        $stmt_profile_create = $db_conn->prepare($sql_profile_create);

        if ($stmt_profile_create->execute(array(self::getLastId("idprofile", "user_profile") + 1, '', '', ''))){
            $id = self::getLastId("idprofile", "user_profile");
//            $sql = "INSERT INTO users ( iduser, email, password, CreatedAt, user_profile_idprofile) VALUES (:iduser, :email, :password, NOW(), :user_profile_idprofile);";
            $sql = "INSERT INTO users ( iduser, email, password, user_profile_idprofile, CreatedAt) VALUES (?, ?, ?, ?, NOW());";
            $stmt = $db_conn->prepare($sql);
            $password = password_hash($password, PASSWORD_DEFAULT);
            return $stmt->execute(array(2, $email, $password, $id));
        }

        return false;

    }

    public static function login($email, $password){
        $db_conn = Database::getConnection();
        $sql = "SELECT iduser, email, password, CreatedAt, user_profile_idprofile FROM users WHERE email = :email" ;

        if($stmt = $db_conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Check if username exists, if yes then verify password
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $id = $row["user_id"];
//                        echo $row["email"];
                        $email = $row["email"];
                        $username = $row["username"];
                        $hashed_password = $row["password"];
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            // Store data in session variables
                            Session::setSession("loggedin", true);
                            Session::setSession("user_id", $id);
                            Session::setSession("email", $email);
                            Session::setSession("username", $username);
                            // Redirect user to welcome page
//                            header("location: welcome.php");
                            echo "<script>window.location.href = `".SITE_URL."index.php`</script>";
                        } else{
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid password.";
                            echo "<script>window.location.href = `".SITE_URL."views/auth/auth.php?error=$login_err`</script>";
                        }
                    }
                } else{
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid email";
                    echo "<script>window.location.href = `".SITE_URL."views/auth/auth.php?error=$login_err`</script>";
                }
            } else{
               $login_err = "Oops! Something went wrong. Please try again later.";
                echo "<script>window.location.href = `".SITE_URL."views/auth/auth.php?error=$login_err`</script>";
            }

            // Close statement
            unset($stmt);
        }

    }
}