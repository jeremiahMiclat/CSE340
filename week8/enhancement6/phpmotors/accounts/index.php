<?php
// Accounts controller

// Create or access a Session
session_start();

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the accounts model
require_once '../model/accounts-model.php';

// Get the array of classifications
$classifications = getClassifications();

// Get the functions library
require_once '../library/functions.php';

$navList = setNavList($classifications);

$action = trim(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
  $action = trim(filter_input(INPUT_GET, 'action'));
}

switch ($action) {

  case 'error':
    include '../view/500.php';
    break;

  case 'login':

    if (isset($_SESSION['loggedin'])) {
      header('Location: /phpmotors/accounts/');
    }


    include '../view/login.php';
    break;

  case 'create':
    if (isset($_SESSION['loggedin'])) {
      header('Location: /phpmotors/accounts/');
    }

    include '../view/registration.php';
    break;

  case 'register':

    if (isset($_SESSION['loggedin'])) {
      header('Location: /phpmotors/accounts/');
    }

    // Filter and store the data
    $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $clientEmail = checkEmail($clientEmail);
    $checkPassword = checkPassword($clientPassword);

    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if ($existingEmail) {
      $_SESSION['message'] = "<p class=''>Sorry that email was already taken.</p>";
      include '../view/login.php';
      exit;
    }

    // Check for missing data
    if (empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($clientPassword)) {
      $message = "<p class=''>Please provide information for all empty form fields.</p>";
      include '../view/registration.php';
      exit;
    }

    //hash the  checked password
    $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

    // Send the data to the model
    $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

    // Check and report the result
    if ($regOutcome === 1) {
      setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
      $_SESSION['message'] = "<p class=''>Thanks for registering $clientFirstname. Please use your email and password to login.</p>";
      header('Location: /phpmotors/accounts/?action=login');
      exit;
    } else {
      $message = "<p class=''>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
      include '../view/registration.php';
      exit;
    }

    break;

  case 'sign-in':
    if (isset($_SESSION['loggedin'])) {
      header('Location: /phpmotors/accounts/');
    }

    $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
    $clientEmail = checkEmail($clientEmail);
    $clientPassword = filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $passwordCheck = checkPassword($clientPassword);


    // Check for missing data
    if (empty($clientEmail) || empty($passwordCheck)) {
      $_SESSION['message'] = "<p class=''>Email and Password must match the requested format.</p>";
      include '../view/login.php';
      exit;
    }


    $existingEmail = checkExistingEmail($clientEmail);

    // Check for existing email address in the table
    if (!$existingEmail) {
      $_SESSION['message'] = "<p class=''>Incorrect Email or Password.</p>";
      include '../view/login.php';
    } else {
      // A valid password exists, proceed with the login process
      // Query the client data based on the email address
      $clientData = getClient($clientEmail);
      // Compare the password just submitted against
      // the hashed password for the matching client
      $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
      // If the hashes don't match create an error
      // and return to the login view
      if (!$hashCheck) {
        $_SESSION['message'] = "<p class=''>Incorrect Email or Password.</p>";
        include '../view/login.php';
        exit;
      }
      // A valid user exists, log them in
      $_SESSION['loggedin'] = TRUE;
      // Remove the password from the array
      // the array_pop function removes the last
      // element from an array
      array_pop($clientData);
      // Store the array into the session
      $_SESSION['clientData'] = $clientData;
      // Send them to the admin view
      include '../view/admin.php';
      exit;
    }



    break;

  default:
    include '../view/admin.php';
}
