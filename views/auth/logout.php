<?php

// Initialize the session
session_start();
require_once getenv("ROOT")."global_constants.php";
// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
//header("location: login.php");
echo "<script>window.location.href = `".SITE_URL."views/auth/auth.php`</script>";
exit;
?>
