<?php
session_start();
// require_once("global_constants.php");
// require("database/UserHelper.php");
include "../../views/components/header/header.php";
?>

<div class="d-flex p-2">
    <div class="card" style="width: 18rem;">

        <form action="AddPropertyAction.php" method="post" enctype="multipart/form-data">
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Title</span>
                <input type="text" class="form-control" name="title" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>


            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Address</span>
                <input type="text" class="form-control" name="address" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Price</span>
                <input type="number" class="form-control" name="price" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Description</span>
                <input type="text" class="form-control" name="description" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>


            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Area</span>
                <input type="number" class="form-control" name="area" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Beds</span>
                <input type="number" class="form-control" name="beds" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Bath</span>
                <input type="number" class="form-control" name="baths" aria-label="Sizing example input"
                       aria-describedby="inputGroup-sizing-default">
            </div>

            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUpload">

            <?php
//            include_once getenv("ROOT")."views/components/map/google_map_api.php";
            require_once(getenv("ROOT")."views/components/map/GetCoords.php");
            GetCoords::get();
            ?>

            <button class="btn btn-primary">Submit</button>
        </form>

    </div>


</div>





