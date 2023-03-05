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
<div class="marginL30px">

<h2>Add New Vehicle Image</h2>
<?php
if (isset($message)) {
 echo $message;
}
?>
<form action="/phpmotors/uploads/" method="post" enctype="multipart/form-data">
 <label for="invItem">Vehicle</label>
	<?php echo $prodSelect; ?>
	<fieldset>
		<label>Is this the main image for the vehicle?</label>
		<label for="priYes" class="pImage">Yes</label>
		<input type="radio" name="imgPrimary" id="priYes" class="pImage" value="1">
		<label for="priNo" class="pImage">No</label>
		<input type="radio" name="imgPrimary" id="priNo" class="pImage" checked value="0">
	</fieldset>
 <label>Upload Image:</label>
 <input type="file" name="file1">
 <input type="submit" class="regbtn" value="Upload">
 <input type="hidden" name="action" value="upload">
</form>
<hr>
<h2>Existing Images</h2>
<p class="notice">If deleting an image, delete the thumbnail too and vice versa.</p>
<?php
 if (isset($imageDisplay)) {
  echo $imageDisplay;
 } ?>





<?php
$page_content = ob_get_clean();
$page_heading = "Image Management";
$page_title = "Image Management";
?>




<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>

<?php unset($_SESSION['message']); ?>