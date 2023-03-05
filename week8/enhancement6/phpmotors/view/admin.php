<?php

if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
} else {
    $clientData = $_SESSION['clientData'];
}

?>

<?php ob_start(); ?>
<div id="adminPageDiv">
    <h2 class="">You are logged in.</h2>
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <ul class="">
        <li class="capitalize">First name: &nbsp;&nbsp;&nbsp;<?php echo $clientData['clientFirstname']; ?></li>
        <li class="capitalize">Last name: &nbsp;&nbsp;&nbsp;&nbsp;<?php echo $clientData['clientLastname']; ?></li>
        <li>Email Address: <?php echo $clientData['clientEmail']; ?></li>
    </ul>

    <?php if ($clientData['clientLevel'] > 1) {

        echo '<a href="/phpmotors/vehicles/" class="">Go to vehicle management.</a> ';
    } ?>
</div>







<?php
$page_content = ob_get_clean();
$page_heading = $clientData['clientFirstname'] . " " . $clientData['clientLastname'];
?>







<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>