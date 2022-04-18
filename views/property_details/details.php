<?php
include_once(getenv("ROOT")."views/components/header/header.php");
require_once(getenv("ROOT")."database/PropertyHelper.php");
$queries = array();
parse_str($_SERVER['QUERY_STRING'], $queries);
$property_id = $queries["property_id"];
$property = PropertyHelper::getPropertyBy($property_id);

?>

<title>Cart Page</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css"
      integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA=="
      crossorigin="anonymous"/>

<div id='cart'>
    <div class="card-wrapper">
        <div class="card">
            <!-- card left -->
            <div class="product-imgs">
                <div class="img-display">
                    <div class="img-showcase">
                        <img src="<?php echo $property["image"]?>" alt="shoe image">
<!--                        <img src="shoes_images/shoe_2.jpg" alt="shoe image">-->
<!--                        <img src="shoes_images/shoe_3.jpg" alt="shoe image">-->
<!--                        <img src="shoes_images/shoe_4.jpg" alt="shoe image">-->
                    </div>
                </div>
<!--                <div class="img-select">-->
<!--                    <div class="img-item">-->
<!--                        <a href="#" data-id="1">-->
<!--                            <img src="shoes_images/shoe_1.jpg" alt="shoe image">-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="img-item">-->
<!--                        <a href="#" data-id="2">-->
<!--                            <img src="shoes_images/shoe_2.jpg" alt="shoe image">-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="img-item">-->
<!--                        <a href="#" data-id="3">-->
<!--                            <img src="shoes_images/shoe_3.jpg" alt="shoe image">-->
<!--                        </a>-->
<!--                    </div>-->
<!--                    <div class="img-item">-->
<!--                        <a href="#" data-id="4">-->
<!--                            <img src="shoes_images/shoe_4.jpg" alt="shoe image">-->
<!--                        </a>-->
<!--                    </div>-->
<!--                </div>-->
            </div>
            <!-- card right -->
            <div class="product-content">
                <h1 style="font-size:30px !important;" class="product-title"><?php echo $property["title"]?></h1>


                <div class="product-price">
                    <p style="font-size:25px !important;" class="new-price">Price: <span><?php echo $property["price"]?> BDT</span></p>
                </div>


                <div class="product-detail">
                    <h2 style="font-size: 30px;">Address:</h2>
                    <p style="font-size: 18px;"><?php echo $property["address"]?></p>
                    <h2 style="font-size:30px !important;">about : </h2>
                    <p style="font-size:18px;"><?php echo $property["details"]?></p>

                    <ul>
                        <li style="font-size:15px !important;">Area: <span style="font-size:12px !important;"><?php echo $property["area"]?> SQFT</span></li>
                        <li style="font-size:15px !important;">Beds: <span style="font-size:12px !important;"><?php echo $property["beds"]?></span></li>
                        <li style="font-size:15px !important;">Baths: <span style="font-size:12px !important;"><?php echo $property["baths"]?></span></li>

                    </ul>
                </div>

                <div class="purchase-info">
                    <button  type="button" class="btn">
                        Call Now <i class="fas fa-phone-alt"></i>

                        <button  type="button" class="btn">
                            Contact US <i class="fas fa-envelope-open-text"></i>
                        </button>

                </div>
            </div>
        </div>
    </div>
    <?php
    require_once(getenv("ROOT")."views/components/map/GetMapView.php");
    $cords = PropertyHelper::getCordByProperty($property["property_id"]);
    GetMapView::get($cords['lat'], $cords['long'], $property['address']);
    ?>
</div>
<script src="script.js"></script>

<?php
include_once(getenv("ROOT")."views/components/footer/footer.php");
?>