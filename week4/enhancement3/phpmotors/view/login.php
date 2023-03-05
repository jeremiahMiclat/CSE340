<?php ob_start(); ?>
<section class="myaccount">
  <h2>Please enter your email and password</h2>
  <form action="/action_page.php">
    <label for="email">Email Address:</label><br>
    <input type="email" id="email" name="email"><br>
    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br><br>
    <input type="submit" value="Sign-in">
  </form>
  <div><a href="/phpmotors/accounts/index.php?action=register" class="signup">Not a member yet? Sign up</a></div>
</section>



<?php
$page_content = ob_get_clean();
$page_heading = "Sign in";
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>