<?php ob_start(); ?>
<section class="myaccount">
  <h2>Please fill out all input fields</h2>
  <form action="/action_page.php">
    <label for="first-name" class="required">First Name</label><br>
    <input type="text" id="first-name" name="fname"><br>
    <label for="last-name" class="required">Last Name</label><br>
    <input type="text" id="last-name" name="lname"><br><br>
    <label for="email" class="required">Email Address</label><br>
    <input type="email" id="email" name="email"><br><br>
    <p class="margin0">Password must be atleast 8 characters</p><br>
    <label for="password" class="required">Password</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Register">
  </form>
  
</section>

<?php
$page_content = ob_get_clean();
$page_heading = "Register";
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>