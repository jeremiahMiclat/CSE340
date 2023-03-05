<?php
// Site Main controller

// Create or access a Session
session_start();

// Get the database connection file
require_once 'library/connections.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

// Get the array of classifications
$classifications = getClassifications();

//get functions.php
require_once 'library/functions.php';


$page_title = 'Home';

$navList = setNavList($classifications);

// Check if the firstname cookie exists, get its value
if (isset($_COOKIE['firstname'])) {
  $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}

$action = trim(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
  $action = trim(filter_input(INPUT_GET, 'action'));
}

switch ($action) {
  case 'error':
    include 'view/500.php';
    break;

  case 'template':
    include 'view/template.php';

    break;

  default:
    include 'view/home.php';
}
