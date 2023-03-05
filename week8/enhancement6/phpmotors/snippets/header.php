<div id="top-header">
    <a href="/phpmotors/index.php">
        <img src="/phpmotors/images/site/logo.png" id="logo" alt="PHP Motors logo">
    </a>
    <div><?php if (!isset($_SESSION['loggedin'])) {

                $loggedOutLink = '<a href="/phpmotors/accounts/index.php?action=login" title="log in or create account" id="myaccount">My Account</a>';
                echo $loggedOutLink;
            } else {
                $clientData = $_SESSION['clientData'];
                $loggedInLinks = "<a href='/phpmotors/accounts/' class='right30px capitalize'>Welcome " . $clientData['clientFirstname'] . "</a>";
                $loggedInLinks .= '<a href="/phpmotors/session/logout.php" class="right30px">Log out</a>';

                echo $loggedInLinks;
            }

            ?>
    </div>
</div>