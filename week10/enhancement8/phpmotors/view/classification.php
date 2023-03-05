
<?php ob_start(); ?>
<div id="classificationsPage">
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
$page_heading = $classificationName . " vehicles";
$page_title = $classificationName . " vehicles | PHP Motors, Inc.";
?>



<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>

<?php unset($_SESSION['message']);?>