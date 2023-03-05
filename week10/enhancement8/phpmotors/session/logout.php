<?php 
session_start();
unset($_SESSION['clientData']);
session_destroy();

header('Location: /phpmotors/');

?>