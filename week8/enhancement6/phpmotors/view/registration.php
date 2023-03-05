<?php ob_start(); ?>
<div class="registration">
<?php
if (isset($message)) {
 echo $message;
}
?>
  <form method="post" action="/phpmotors/accounts/index.php">
  <label for="first-name" class="">First Name</label><br>
    <input type="text" id="first-name" name="clientFirstname" <?php if(isset($clientFirstname)){echo "value='$clientFirstname'";}  ?> required><br><br>
    <label for="last-name" class="">Last Name</label><br>
    <input type="text" id="last-name" name="clientLastname" <?php if(isset($clientLastname)){echo "value='$clientLastname'";}  ?> required><br><br>
    <label for="email" class="">Email Address</label><br>
    <input type="email" id="email" name="clientEmail" <?php if(isset($clientEmail)){echo "value='$clientEmail'";}  ?> required><br><br>
    <label for="clientPassword">Password:</label><br><br>
    <span>(Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character)</span><br>
    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
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