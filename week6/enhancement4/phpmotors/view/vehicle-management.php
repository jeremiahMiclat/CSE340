<?php ob_start(); ?>
<div class="vehicle_management">
<?php
if (isset($message)) {
 echo $message;
}
?>
  <ul>
      <li><a href="/phpmotors/vehicles/index.php?action=add-classification" class="hover-underline">Add Classification</a></li>
      <li><a href="/phpmotors/vehicles/index.php?action=add-vehicle" class="hover-underline">Add Vehicle</a></li>
  </ul>
</div>



<?php
$page_content = ob_get_clean();
$page_heading = "Vehicle Management";
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>