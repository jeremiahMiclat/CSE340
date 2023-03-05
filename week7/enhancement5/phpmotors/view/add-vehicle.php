<?php ob_start(); ?>
<?php
$classificationDDL = '<br><br><label for="carclassificationId" class="">Choose Car Classification</label><br>';
$classificationDDL .= '<select name="classificationId" id="carclassificationId" required>';
$classificationDDL .= '<option disabled selected value> -- select classification -- </option>';

foreach ($classificationsNameId as $classificationNameId) {

    $classificationDDL .= "<option value='$classificationNameId[classificationId]'";

    if (isset($classificationId)) {
        if ($classificationNameId['classificationId'] === $classificationId) {
            $classificationDDL .= " selected";
        }
    }

    $classificationDDL .= ">$classificationNameId[classificationName]</option>";
}

$classificationDDL .= '</select>';

?>
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
        <label for="make" class="required">Make</label><br>
        <input type="text" id="make" name="invMake" <?php if (isset($invMake)) {
                                                        echo "value='$invMake'";
                                                    }  ?> required><br><br>

        <label for="model" class="required">Model</label><br>
        <input type="text" id="model" name="invModel" <?php if (isset($invModel)) {
                                                            echo "value='$invModel'";
                                                        }  ?> required><br><br>

        <label for="description" class="required">Description</label><br>
        <textarea id="description" name="invDescription" rows="3" cols="50" required><?php if (isset($invDescription)) {
                                                                                            echo $invDescription;
                                                                                        }  ?></textarea><br><br>
        <label for="invimage" class="required">Image Path</label><br>
        <input type="text" id="invimage" name="invImage" value="/phpmotors/no-image/no-image.png" <?php if (isset($invImage)) {
                                                                                                        echo "value='$invImage'";
                                                                                                    }  ?> required><br><br>

        <label for="invthumbnail" class="required">Thumbnail Path</label><br>
        <input type="text" id="invthumbnail" name="invThumbnail" value="/phpmotors/no-image/no-image.png" <?php if (isset($invThumbnail)) {
                                                                                                                echo "value='$invThumbnail'";
                                                                                                            }  ?> required><br><br>

        <label for="invprice" class="required">Price</label><br>
        <input type="number" step="any" id="invprice" name="invPrice" <?php if (isset($invPrice)) {
                                                                            echo "value='$invPrice'";
                                                                        }  ?> required><br><br>

        <label for="invstock" class="required">Stock</label><br><br>
        <span>Number only, no decimal.</span><br>
        <input type="number" id="invstock" name="invStock" <?php if (isset($invStock)) {
                                                                echo "value='$invStock'";
                                                            }  ?> required><br><br>

        <label for="invcolor" class="required">Color</label><br>
        <input type="text" id="invcolor" name="invColor" <?php if (isset($invColor)) {
                                                                echo "value='$invColor'";
                                                            }  ?> required><br><br>

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