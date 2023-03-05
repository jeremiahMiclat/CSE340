<?php
//check user level or not logged in
if (!isset($_SESSION['loggedin']) || !($_SESSION['clientData']['clientLevel'] > 1)) {
  header('Location: /phpmotors/');
}
if (isset($_SESSION['message'])) {
  $message = $_SESSION['message'];
}
?>
<?php ob_start(); ?>
<div class="vehicle_management">
  <?php
  if (isset($message)) {
    echo $message;
  }
  ?>
  <ul>
    <li><a href="/phpmotors/vehicles/index.php?action=add-classification" class="">Add Classification</a></li>
    <li><a href="/phpmotors/vehicles/index.php?action=add-vehicle" class="">Add Vehicle</a></li>
  </ul>
  <?php
  if (isset($classificationList)) {
    echo '<h2 class="top20px">Vehicles By Classification</h2>';
    echo '<p class="">Choose a classification to see those vehicles</p>';
    echo $classificationList;
  }
  ?>


  <noscript>
    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
  </noscript>
  <table class="top20px" id="inventoryDisplay"></table>

  <?php
  $jsscript = '<script src="../js/inventory.js"></script>';
  ?>
  <?php
  if (isset($jsscript)) {
    echo $jsscript;
  }
  ?>
</div>




<?php
$page_content = ob_get_clean();
$page_heading = "Vehicle Management";
?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>
<?php unset($_SESSION['message']); ?>