<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once(getenv("ROOT")."Session.php");
require_once("../../database/UserHelper.php");
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo "<script>window.location.href = `".SITE_URL."index.php`</script>";
    exit;
}


// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = $login_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){


    // Check if username is empty
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter username.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        UserHelper::login($email, $password);
        // Prepare a select statement

    }
}
