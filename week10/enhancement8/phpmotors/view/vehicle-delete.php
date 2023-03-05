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
    $page_title = "Delete $invInfo[invMake] $invInfo[invModel] | PHP Motors";
    $page_heading = "Delete $invInfo[invMake] $invInfo[invModel]";
} elseif (isset($invMake) && isset($invModel)) {
    $page_heading = "Delete $invMake $invModel";
} ?>

<?php


ob_start(); ?>


<div id="vehicleDelete">
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/vehicles/">
        <br>
        <br>
        <fieldset>
            <label for="invMake">Vehicle Make</label>

            <input type="text" readonly name="invMake" id="invMake" <?php
                                                                    if (isset($invInfo['invMake'])) {
                                                                        echo "value='$invInfo[invMake]'";
                                                                    } ?>><br><br>

            <label for="invModel">Vehicle Model</label>
            <input type="text" readonly name="invModel" id="invModel" <?php
                                                                        if (isset($invInfo['invModel'])) {
                                                                            echo "value='$invInfo[invModel]'";
                                                                        } ?>><br><br>

            <label for="invDescription">Vehicle Description:</label>
            <br>
            <textarea name="invDescription" readonly id="invDescription" cols="50" rows="3"><?php
                                                                                            if (isset($invInfo['invDescription'])) {
                                                                                                echo $invInfo['invDescription'];
                                                                                            }
                                                                                            ?></textarea>
            <br><br>
            <input type="submit" class="regbtn" name="submit" value="Delete Vehicle">

            <input type="hidden" name="action" value="deleteVehicle">
            <input type="hidden" name="invId" value="<?php if (isset($invInfo['invId'])) {
                                                            echo $invInfo['invId'];
                                                        } ?>">

        </fieldset>
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