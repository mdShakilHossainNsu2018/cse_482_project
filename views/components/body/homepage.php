<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <link rel="stylesheet" href='<?php

    echo SITE_URL ?>views/components/body/style.css'>

</head>

<body>
<div id="main-body">
    <!-- services -->

    <section class="services" id="services">

        <h1 class="heading"> our <span>services</span></h1>

        <div class="box-container">


            <div class="box">
                <img src="<?php

                echo SITE_URL ?>views/components/body/images/s-1.png" alt="">
                <h3>buying home</h3>
                <p>Homeownership can be very exciting, but it isn’t always the best thing for everyone. Before you decide to buy a home, make sure you carefully consider the costs.</p>
                <a href="#" class="main-btn">learn more</a>
            </div>


            <div class="box">
                <img src="<?php

                echo SITE_URL ?>views/components/body/images/s-2.png" alt="">
                <h3>renting home</h3>
                <p>Many people mull over the idea of renting out their homes. They may want the benefit of extra income
                    to save money or pay down debt, or they may see it as an option to selling during a housing slump, a
                    way to wait things out until the economy improves.</p>
                <a href="#" class="main-btn">learn more</a>
            </div>

            <div class="box">
                <img src="<?php

                echo SITE_URL ?>views/components/body/images/s-3.png" alt="">
                <h3>selling home</h3>
                <p>Selling a home normally takes 2 to 3 months. The process can take longer if you’re part of a chain of
                    buyers and sellers. Be with us to cut that time.</p>
                <a href="#" class="main-btn">learn more</a>
            </div>

        </div>

    </section>

    <!-- services end point -->


    <!-- featured section -->

    <section class="featured" style="margin-top: 1rem;" id="featured">

        <h1 class="heading"><span>featured</span> properties </h1>

        <div class="box-container">

            <?php
            require_once(getenv("ROOT") . "database/PropertyHelper.php");
            require_once(getenv("ROOT") . "/global_constants.php");
            $properties = PropertyHelper::getAllProperty();

            if ($properties) {
                foreach ($properties as $property) {
                    $url = SITE_URL . "views/property_details/details.php?property_id=". $property["property_id"];
                    echo <<< EOT
           <div class="box">
                <div class="image-container">
                    <img src="{$property['image']}" alt="">
                    <div class="info">
                        <h3>{$property["created_at"]}</h3>
                      
                    </div>
                   
                </div>
                <div class="content">
                    <div class="price">
                        <h3>৳{$property["price"]}/mo</h3>
                    </div>
                    <div class="location">
                        <h3>{$property["title"]}</h3>
                        <p>{$property["address"]}</p>
                    </div>
                    <div class="details">
                        <h3><i class="fas fa-expand"></i> {$property["area"]} sqft </h3>
                        <h3><i class="fas fa-bed"></i> {$property["beds"]} </h3>
                        <h3><i class="fas fa-bath"></i> {$property["baths"]} baths </h3>
                    </div>
                    <div class="buttons">
<!--                        <a href="#" class="btn">request info</a>-->
                        <a href="{$url}" class="main-btn">view details</a>
                    </div>
                </div>
            </div>         
EOT;
                }
            }
            ?>




        </div>

    </section>

</div>
<!-- featured end point -->


</body>
</html>