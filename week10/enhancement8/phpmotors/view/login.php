<?php ob_start(); ?>
<section class="myaccount">
  <h2>Please enter your email and password</h2>
  <?php
  if (isset($_SESSION['message'])) {
    echo "<p class=''>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
  }
  ?>
  <form method="post">
    <br><label for="clientEmail">Email Address:</label><br>
    <input type="email" id="clientEmail" name="clientEmail" <?php if (isset($clientEmail)) {
                                                              echo "value='$clientEmail'";
                                                            } ?> required><br><br>
    <label for="clientPassword">Password:</label><br><br>
    <span>(Passwords is at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character)</span><br>
    <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>
    <input type="submit" value="Sign-in">
    <!-- Add the action name - value pair -->
    <input type="hidden" name="action" value="sign-in">
  </form>
  <div><a href="/phpmotors/accounts/index.php?action=create" class="signup">Not a member yet? Sign up</a></div>
</section>

<?php
$page_content = ob_get_clean();
$page_heading = "Sign in";
?>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>