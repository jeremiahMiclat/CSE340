<?php

if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
} else {
    $clientData = $_SESSION['clientData'];
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
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

    <?php

    $accManagement =  "<br><h3 class=''>Account Management</h3><br>";
    $accManagement .= "<p class=''>Use this link to update account information.</p>";
    $accManagement .= '<a href="/phpmotors/accounts/index.php?action=client-update&clientId=';
    $accManagement .= $clientData['clientId'];
    $accManagement .= '" class="underlined">Update account information.</a> ';

    $userInfo = "<ul class=''>"
    . "<li>First name: " . $clientData['clientFirstname'] . "</li>"
    . "<li>Last name: " . $clientData['clientLastname']
    . "</li> <li>Email: " . $clientData['clientEmail'] . "</li></ul>";

    if ($clientData['clientLevel'] > 1) {



        $invManagement = "<h2 class=''>Inventory Management</h2>";
        $invManagement .= "<br><p class=''>Use this link to manage inventory.</p>";
        $invManagement .= '<a href="/phpmotors/vehicles/" class="underlined">Go to vehicle management.</a> ';



        echo $userInfo;
        echo $accManagement;
        echo  $invManagement;
    } else {


        echo $userInfo;
        echo $accManagement;
    }

    ?>

</div>







<?php
$page_content = ob_get_clean();
$page_heading = $clientData['clientFirstname'] . " " . $clientData['clientLastname'];
$page_title = $clientData['clientFirstname'] . " " . $clientData['clientLastname'] . " - " . "My Account";
?>







<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>

<?php unset($_SESSION['message']); ?>