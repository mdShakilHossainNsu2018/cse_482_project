<?php
require_once(getenv("ROOT") . "database/UserHelper.php");
require_once(getenv("ROOT") . "global_constants.php");
require_once(getenv("ROOT") . "Session.php");


if($_SERVER["REQUEST_METHOD"] == "POST"){

    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $profile_id = $_POST['profile_id'];
    $target_dir = getenv("ROOT")."media/";
    $filename   = uniqid() . "-" . round(microtime(true));
    $extension  = pathinfo( $_FILES["fileToUpload"]["name"], PATHINFO_EXTENSION );
    $basename   = $filename . "." . $extension;
    $target_file = $target_dir . $basename;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    if ($extension != ""){
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }


// Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

// Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

// Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

// Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
        } else {

            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        $image_url = SITE_URL . 'media/'. $basename;
    } else{
        $image_url = $_POST['default_image'];
    }


    // //$title, image, $description, $area, $price, $beds, $baths, $address, $lat, $long, $user_id
    if(UserHelper::updateProfile(
        $profile_id, $phone, $address, $name, $image_url
    )){
        echo "<script>window.location.href = `" . SITE_URL . "views/profile/profile.php`</script>";
    }


}