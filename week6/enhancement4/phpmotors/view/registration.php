<?php ob_start(); ?>
<div class="registration">
<?php
if (isset($message)) {
 echo $message;
}
?>
  <form method="post" action="/phpmotors/accounts/index.php">
    <label for="first-name" class="required">First Name</label><br>
    <input type="text" id="first-name" name="clientFirstname"><br>
    <label for="last-name" class="required">Last Name</label><br>
    <input type="text" id="last-name" name="clientLastname"><br><br>
    <label for="email" class="required">Email Address</label><br>
    <input type="email" id="email" name="clientEmail"><br><br><br>
    <p class="">Password must be atleast 8 characters</p>
    <label for="password" class="required">Password</label><br>
    <input type="password" id="password" name="clientPassword"><br><br>
    <p class="">*All fields are required</p>
    <input type="submit" name="submit" id="regbtn" value="Register">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="register">
  </form>

</div>

<?php
$page_content = ob_get_clean();
$page_heading = "Register";
?>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>