<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once("../../global_constants.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Auth</title>

    <link rel="stylesheet" href="auth.css">
</head>
<body>
<?php
//
include "../components/header/header.php";
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);

//$user_id = $queries["user_id"] ?? $users[0]["user_id"];


if (isset($queries["error"])){
    $error = $queries["error"];
    echo "
<div class='container p-3'>
    <div class='alert alert-danger' role='alert'>
    $error
</div>
</div>


    ";
}
//?>



<div class="auth-body">

    <div class="auth-container" id="auth-container">
        <div class="form-container sign-up-container">
            <form action="SignupAction.php" method="POST">
                <h1>Create Account</h1>
                <!--            <div class="social-container">-->
                <!--                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>-->
                <!--            </div>-->
                <!--            <span>or use your email for registration</span>-->
                <input type="text" name="name" placeholder="Name" style="font-size:15px" />
                <input type="email" name="email" placeholder="Email" style="font-size:15px"/>
                <input type="password" name="password" placeholder="Password" style="font-size:15px" />
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="LoginAction.php" method="post">
                <h1>Sign in</h1>
                <!--            <div class="social-container">-->
                <!--                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>-->
                <!--            </div>-->
                <!--            <span>or use your account</span>-->
                <input type="email" placeholder="Email" name="email" style="font-size:15px" />
                <input type="password" placeholder="Password" name="password" style="font-size:15px"/>
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

include "../components/footer/footer.php";
?>

<script src="auth.js"></script>

</body>
</html>