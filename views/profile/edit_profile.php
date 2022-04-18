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

    .edit-input{
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        padding: 1rem;
        justify-content: space-between;
        height: 15rem;
    }

</style>
<div class="profile-wrapper">
    <div class="card-profile">
        <form action="edit_profile_action.php" method="post" enctype="multipart/form-data">
            <img src="<?php echo $user['image'] == null ? SITE_URL . 'views/profile/place_holder.png' : $user['image']; ?>"
                 alt="John" style="width:100%">
            <div class="edit-input">
                <input type="file" name="fileToUpload" id="fileToUpload">
                <input value="<?php echo $user['image'] ?>" type="text" name="default_image" hidden>
                <input type="text" name="name" value="<?php echo $user['name'] ?>" placeholder="Your name">


                <input type="text" hidden name="profile_id" value="<?php echo $user['profile_id'] ?>">
                <input type="text" name="phone" value="<?php echo $user['phone'] ?>" placeholder="Your phone number">
                <textarea type="address" name="address" placeholder="Your address">
                <?php echo $user['address'] ?>
            </textarea>
            </div>


            <p>
                <button class="profile-btn" type="submit">Save</button>
            </p>
        </form>


    </div>
</div>
