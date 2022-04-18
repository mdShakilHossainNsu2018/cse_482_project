<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// require_once("global_constants.php");
// require("database/UserHelper.php");
include "../../views/components/header/header.php";
require_once(getenv("ROOT") . "Session.php");
?>

<link rel="stylesheet" href='<?php

echo SITE_URL ?>views/add_property/style.css'>


<div class='property'>
    <div class="property_container">

        <div class="property-form-container">

            <form action="AddPropertyAction.php" method="post" enctype="multipart/form-data">
                <h3>Add a new property</h3>
                <?php
                $user_id = Session::getLoggedInUserId();
                echo "<input type='text' value='$user_id' hidden name='user_id'>";

                ?>
                <label for="title">Title: </label>
                <input type="text" placeholder="Enter property title" id="title" name="title" class="box">

                <label for="title">Description: </label>
                <textarea type="test"  placeholder="Enter Description" id="description" name="description" class="box"></textarea>

                <label for="address">Address: </label>
                <input type="text" id="address" placeholder="Enter address" name="address" class="box">

                <label for="price">Price: </label>
                <input type="number" id="price" placeholder="Enter price" name="price" class="box" required>
                <label for="area">Area: </label>
                <input type="number" id="area" placeholder="Enter Area in sqft" name="area" class="box">
                <label for="beds">Beds: </label>
                <input type="number" id="beds" placeholder="Enter Total no of beds" name="beds" class="box">
                <label for="baths">Baths: </label>
                <input type="number" id="baths" placeholder="Enter no of Baths" name="baths" class="box">
                <label for="fileToUpload">Upload Image: </label>
                <input type="file" name="fileToUpload" id="fileToUpload"  class="box">

                <?php
                //            include_once getenv("ROOT")."views/components/map/google_map_api.php";
                require_once(getenv("ROOT") . "views/components/map/GetCoords.php");
                GetCoords::get();
                ?>

                <input type="submit" class="submit_btn" name="add_product" value="add property">
            </form>

        </div>
    </div>
</div>

<?php
include_once(getenv("ROOT")."views/components/footer/footer.php");
?>