<?php
require_once(getenv("ROOT") . "Session.php");
require_once(getenv("ROOT") . "database/UserHelper.php");
$user_id = Session::getLoggedInUserId();
include_once(getenv("ROOT") . "views/components/header/header.php");

$user = UserHelper::getUserById($user_id);

?>


<style type="text/css" scoped>
    .card-profile {

        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
        max-width: 30vw;
        margin: auto;
        text-align: center;
    }

    .profile-wrapper {
        padding: 3rem;
    }

    .title {
        color: grey;
        font-size: 18px;
    }

    .profile-btn {
        border: none;
        outline: 0;
        display: inline-block;
        padding: 8px;
        color: white;
        background-color: #000;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 18px;
        text-decoration: none;
    }

    /*a {*/
    /*    text-decoration: none;*/
    /*    font-size: 22px;*/
    /*    color: black;*/
    /*}*/

    a:hover, a:hover {
        opacity: 0.7;
    }
</style>
<div class="profile-wrapper">
    <div class="card-profile">
        <img src="<?php echo $user['image'] == null ? SITE_URL . 'views/profile/place_holder.png' : $user['image']; ?>"
             alt="John" style="width:100%">

        <h1>Name: <?php echo $user['name']; ?></h1>
        <p class="title">Email: <?php echo $user['email']; ?></p>
        <p><?php echo $user['phone']; ?></p>
        <p><?php echo $user['address']; ?></p>

        <p><a class="profile-btn" href="<?php echo SITE_URL.'views/profile/edit_profile.php' ?>">Edit profile</a></p>
    </div>
</div>
