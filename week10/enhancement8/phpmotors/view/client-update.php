<?php
//check user not logged in
if (!isset($_SESSION['loggedin'])) {
    header('Location: /phpmotors/');
}

if (isset($_SESSION['clientData'])) {
    $clientData = $_SESSION['clientData'];
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
}
?>

<?php ob_start(); ?>
<div id="clientUpdate">
    <?php
    if (isset($message)) {
        echo $message;
    }
    ?>
    <form method="post" action="/phpmotors/accounts/index.php?action=client-update&clientId=<?php
    echo $clientData['clientId']?>">
        <br><label for="first-name" class="required">First Name</label><br>
        <input type="text" id="first-name" name="clientFirstname" <?php if (isset($clientFirstname)) {
                                                                        echo "value='$clientFirstname'";
                                                                    } elseif (isset($clientinfo['clientFirstname'])) {
                                                                        echo "value='$clientinfo[clientFirstname]'";
                                                                    } ?> required><br><br>
        <label for="last-name" class="required">Last Name</label><br>
        <input type="text" id="last-name" name="clientLastname" <?php if (isset($clientLastname)) {
                                                                    echo "value='$clientLastname'";
                                                                } elseif (isset($clientinfo['clientLastname'])) {
                                                                    echo "value='$clientinfo[clientLastname]'";
                                                                }  ?> required><br><br>
        <label for="email" class="required">Email Address</label><br>
        <input type="email" id="email" name="clientEmail" <?php if (isset($clientEmail)) {
                                                                echo "value='$clientEmail'";
                                                            } elseif (isset($clientinfo['clientEmail'])) {
                                                                echo "value='$clientinfo[clientEmail]'";
                                                            }  ?> required><br><br>
        <input type="submit" name="submit" id="updatebtn" value="Update Info">
        <input type="hidden" name="action" value="updateAccount">
        <input type="hidden" name="clientId" value="
<?php if (isset($clientinfo['clientId'])) {
    echo $clientinfo['clientId'];
} elseif (isset($clientId)) {
    echo $clientId;
} ?>
">

    </form>





    <form method="post" action="/phpmotors/accounts/index.php?action=client-update&clientId=<?php
    echo $clientData['clientId']?>">
        <label for="clientPassword">Password:</label><br><br>
        <span>*Note: Original password will be changed.</span><br><br>
        <span class="font12px">(Passwords must be at least 8 characters and contain at least 1 number, 1 capital letter and 1 special character)</span><br><br>
        
        <?php
        if (isset($_SESSION['passworderrormsg'])) {
            echo $_SESSION['passworderrormsg'];
        }
        ?>
        <input type="password" name="clientPassword" id="clientPassword" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"><br><br>


        <input type="submit" name="submit" id="updatepwbtn" value="Change Password">
        <input type="hidden" name="action" value="changePassword">
        <input type="hidden" name="clientId" value="
        <?php if (isset($clientinfo['clientId'])) {
            echo $clientinfo['clientId'];
        } elseif (isset($clientId)) {
            echo $clientId;
        } ?>
">
    </form>

</div>


<?php
$page_content = ob_get_clean();
$page_heading = "Update Account Information";
?>

<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/view/template.php'; ?>

<?php unset($_SESSION['message']);
unset($_SESSION['passworderrormsg']);
?>