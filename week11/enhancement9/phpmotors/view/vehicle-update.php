<?php
//check user level or not logged in
if (!isset($_SESSION['loggedin']) || !($_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: /phpmotors/');
}
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
  }
?>

<?php if (isset($invInfo['invMake']) && isset($invInfo['invModel'])) {
    $page_heading = "Modify $invInfo[invMake] $invInfo[invModel]";
} elseif (isset($invMake) && isset($invModel)) {
    $page_heading = "Modify $invMake $invModel";
} ?>

<?php


ob_start(); ?>

<?php

$classificationDD = '<br><br><label for="carclassificationId" class="required">Choose Car Classification</label><br>';

$classificationDD .= '<select name="classificationId" id="carclassificationId" required>';



$classificationDD .= '<option disabled selected value> -- select classification -- </option>';


foreach ($classificationsNameId as $classificationNameId) {

    $classificationDD .= "<option value='$classificationNameId[classificationId]'";

    if (isset($classificationId)) {
        if ($classificationNameId['classificationId'] === $classificationId) {
            $classificationDD .= " selected";
        }
    } elseif (isset($invInfo['classificationId'])) {
        if ($classificationNameId['classificationId'] === $invInfo['classificationId']) {
            $classificationDD .= ' selected ';
        }
    }


    $classificationDD .= ">$classificationNameId[classificationName]</option>";
}

$classificationDD .= '</select>';

?>
<div id="vehicleUpdate">
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" id="addVehicleForm">
        <?php if (isset($classificationDD)) {
            echo $classificationDD;
        } ?>
        <br>
        <br>
        <label for="make" class="required">Make</label><br>



        <input type="text" name="invMake" id="Make" required <?php if (isset($invMake)) {
                                                                    echo "value='$invMake'";
                                                                } elseif (isset($invInfo['invMake'])) {
                                                                    echo "value='$invInfo[invMake]'";
                                                                } ?>>
        <br><br>

        <label for="model" class="required">Model</label><br>
        <input type="text" name="invModel" id="model" required <?php if (isset($invModel)) {
                                                                    echo "value='$invModel'";
                                                                } elseif (isset($invInfo['invModel'])) {
                                                                    echo "value='$invInfo[invModel]'";
                                                                } ?>><br><br>

        <label for="description" class="required">Description</label><br>


        <textarea name="invDescription" id="description" rows="3" cols="50" required>
<?php if (isset($invDescription)) {
    echo $invDescription;
} elseif (isset($invInfo['invDescription'])) {
    echo $invInfo['invDescription'];
} ?></textarea><br><br>
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
                                                                        } elseif (isset($invInfo['invPrice'])) {
                                                                            echo "value='$invInfo[invPrice]'";
                                                                        } ?> required><br><br>

        <label for="invstock" class="required">Stock</label><br><br>
        <span>Number only, no decimal.</span><br>
        <input type="number" id="invstock" name="invStock" <?php if (isset($invStock)) {
                                                                echo "value='$invStock'";
                                                            } elseif (isset($invInfo['invStock'])) {
                                                                echo "value='$invInfo[invStock]'";
                                                            }  ?> required><br><br>

        <label for="invcolor" class="required">Color</label><br>
        <input type="text" id="invcolor" name="invColor" <?php if (isset($invColor)) {
                                                                echo "value='$invColor'";
                                                            } elseif (isset($invInfo['invColor'])) {
                                                                echo "value='$invInfo[invColor]'";
                                                            } ?> required><br><br>

        <input type="submit" name="submit" value="Update Vehicle">
        <!-- Add the action name - value pair -->
        <input type="hidden" name="action" value="updateVehicle">

        <input type="hidden" name="invId" value="
<?php if (isset($invInfo['invId'])) {
    echo $invInfo['invId'];
} elseif (isset($invId)) {
    echo $invId;
} ?>
">
    </form>



</div>



<?php
$page_content = ob_get_clean();
?>

<?php
/*include 'view/template.php';*/
?>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>
<?php unset($_SESSION['message']); ?>