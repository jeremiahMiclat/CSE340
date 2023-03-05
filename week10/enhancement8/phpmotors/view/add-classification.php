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
<div class="add_classification">
  <?php
  if (isset($message)) {
    echo $message;
  }
  ?>
  <form method="post" action="/phpmotors/vehicles/index.php">
    <label for="addClass" class="required">Make</label><br>
    <input type="text" id="addClass" name="classificationName" maxlength="30" required><br><br>
    <input type="submit" name="submit" id="addClassbtn" value="Add">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="add-class">
  </form>

</div>

<?php
$page_content = ob_get_clean();
$page_heading = "Add classification";
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>
<?php unset($_SESSION['message']); ?>