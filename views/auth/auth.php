<?php
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
include "../components/header/header.php"
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
                <input type="text" name="name" placeholder="Name" />
                <input type="email" name="email" placeholder="Email" />
                <input type="password" name="password" placeholder="Password" />
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#">
                <h1>Sign in</h1>
                <!--            <div class="social-container">-->
                <!--                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>-->
                <!--                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>-->
                <!--            </div>-->
                <!--            <span>or use your account</span>-->
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
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