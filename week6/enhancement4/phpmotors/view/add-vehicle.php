<?php ob_start(); ?>
<div class="add_vehicle">
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/vehicles/index.php">
        <?php if (isset($classificationDDL)) {
            echo $classificationDDL;
        } ?>
        <br>
        <br>
        <label for="make">Make</label><br>
        <input type="text" id="make" name="invMake"><br><br>

        <label for="model">Model</label><br>
        <input type="text" id="model" name="invModel"><br><br>

        <label for="description">Description</label><br>
        <input type="text" id="description" name="invDescription"><br><br>

        <label for="invimage">Image Path</label><br>
        <input type="text" id="invimage" name="invImage" value="/phpmotors/no-image/no-image.png"><br><br>

        <label for="invthumbnail">Thumbnail Path</label><br>
        <input type="text" id="invthumbnail" name="invThumbnail" value="/phpmotors/no-image/no-image.png"><br><br>

        <label for="invprice">Price</label><br>
        <input type="number" step="any" id="invprice" name="invPrice"><br><br>

        <label for="invstock">Stock</label><br>
        <input type="number" id="invstock" name="invStock"><br><br>

        <label for="invcolor">Color</label><br>
        <input type="text" id="invcolor" name="invColor"><br><br>

        <p>*All fields must be filled up</p>

        <input type="submit" name="submit" id="addbtn" value="Add vehicle">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="addInv">
    </form>



</div>

<?php
$page_content = ob_get_clean();
$page_heading = "Add Vehicle";
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>