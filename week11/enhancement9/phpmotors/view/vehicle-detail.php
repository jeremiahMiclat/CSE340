<?php ob_start(); ?>
<div id="vehicleDetail">
<?php
if (isset($_SESSION['message'])) {
 echo $_SESSION['message'];
}
?>
<?php if(isset($vehicleDisplay)){
 echo $vehicleDisplay;
} ?>

</div>


<?php
$page_content = ob_get_clean();
$page_heading = $vehicleDetail['invMake'] . " " . $vehicleDetail['invModel'];
$page_title =  $vehicleDetail['invMake'] . " " . $vehicleDetail['invModel'] . " vehicles | PHP Motors, Inc.";
?>



<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>

<?php unset($_SESSION['message']);?>