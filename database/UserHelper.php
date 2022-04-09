<?php
require_once(getenv("ROOT") . "Session.php");
require_once("connection.php");
require_once(getenv("ROOT") . "global_constants.php");


class UserHelper
{
    public static function getAllUsers()
    {
        try {
            $db_conn = Database::getConnection();
            $stmt = $db_conn->prepare("SELECT * FROM users");
            $stmt->execute();
            return $stmt->fetchAll();
        } catch (PDOException $e) {
            echo "<h1>Error while fetching all user</h1>";
            echo $e->getMessage();
        }
        return null;
    }

    public static function getLastUserId(){
        try {
            $db_conn = Database::getConnection();
            $stmt = $db_conn->prepare("select MAX(user_id) as user_id from users;");
            $stmt->execute();
            return $stmt->fetch();
        } catch (PDOException $e) {
            echo "<h1>Error while fetching all user</h1>";
            echo $e->getMessage();
        }
        return null;
    }


    public static function createUser($username, $email, $password): bool
    {
        try {
            $db_conn = Database::getConnection();
        } catch (PDOException $exception){
            echo "<h1>Error while connecting to database</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $sql = "INSERT INTO users ( email, password) VALUES (?, ?);";
            $stmt = $db_conn->prepare($sql);
            $password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->execute(array($email, $password));
        } catch (PDOException $exception){
            echo "<h1>Error while create user.</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $last_user_id = $db_conn->lastInsertId();
            $sql_profile_create = "insert into user_profile ( name,  users_user_id) VALUES (?, ?);";
            $stmt_profile_create = $db_conn->prepare($sql_profile_create);
            return $stmt_profile_create->execute(array($username, $last_user_id));

        } catch (PDOException $exception){
            echo "<h1>Error while creating profile</h1>";
            echo $exception->getMessage();
            return false;
        }
    }

    public static function login($email, $password): bool
    {
        try {
            $db_conn = Database::getConnection();
        } catch (PDOException $exception){
            echo "<h1>Error while connecting to database</h1>";
            echo $exception->getMessage();
            return false;
        }

        try {
            $sql = "SELECT user_id, email, password, name FROM users JOIN user_profile ON users.user_id = user_profile.users_user_id WHERE email = :email";

            if ($stmt = $db_conn->prepare($sql)) {
                // Bind variables to the prepared statement as parameters
                $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

                // Set parameters
                $param_email = trim($_POST["email"]);

                // Attempt to execute the prepared statement
                if ($stmt->execute()) {
                    // Check if username exists, if yes then verify password
                    if ($stmt->rowCount() == 1) {
                        if ($row = $stmt->fetch()) {
                            $id = $row["user_id"];
                            $email = $row["email"];
                            $username = $row["name"];
                            $hashed_password = $row["password"];
                            if (password_verify($password, $hashed_password)) {
                                // Password is correct, so start a new session
                                // Store data in session variables
                                Session::setSession("loggedin", true);
                                Session::setSession("user_id", $id);
                                Session::setSession("email", $email);
                                Session::setSession("username", $username);
                                // Redirect user to welcome page
//                            header("location: welcome.php");
                                echo "<script>window.location.href = `" . SITE_URL . "index.php`</script>";
                            } else {
                                // Password is not valid, display a generic error message
                                $login_err = "Invalid password.";
                                echo "<script>window.location.href = `" . SITE_URL . "views/auth/auth.php?error=$login_err`</script>";
                            }
                        }
                    } else {
                        // Username doesn't exist, display a generic error message
                        $login_err = "Invalid email";
                        echo "<script>window.location.href = `" . SITE_URL . "views/auth/auth.php?error=$login_err`</script>";
                    }
                } else {
                    $login_err = "Oops! Something went wrong. Please try again later.";
                    echo "<script>window.location.href = `" . SITE_URL . "views/auth/auth.php?error=$login_err`</script>";
                }
            }
            return true;

        } catch (PDOException $exception){
            echo "Error while login";
            echo $exception->getMessage();
            return false;
        }
    }
}