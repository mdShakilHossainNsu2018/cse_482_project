<?php
//Including Database configuration file.
require_once(getenv("ROOT")."database/connection.php");
require_once(getenv("ROOT")."global_constants.php");
//Getting value of "search" variable from "script.js".
if (isset($_POST['search'])) {
//Search box value assigning to $Name variable.
    $Name = $_POST['search'];
//Search query.
    $Query = "SELECT * FROM properties WHERE properties.address LIKE '%$Name%' LIMIT 5";
//Query execution
    $conn = Database::getConnection();
    $stem = $conn->prepare($Query);
    $stem->execute();
    $results = $stem->fetchAll();
//Creating unordered list to list-group result.
    //Fetching result from database.
    if($results){
        foreach ($results as $result){
            ?>
            <a href="<?php echo SITE_URL."views/property_details/details.php?property_id=".$result['property_id']; ?>" class="list-group-item list-group-item-action">
                <h3><?php echo $result['title']; ?></h3>
                <p><?php echo $result['address']; ?></p>
            </a>
        <?php
    }} }
?>
