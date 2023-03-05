<?php
// Site Main controller

// Create or access a Session
session_start();


//check user level or not logged in
if (!isset($_SESSION['loggedin']) || !($_SESSION['clientData']['clientLevel'] > 1)) {
    header('Location: /phpmotors/');
 
}

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();
$classificationsNameId = getClassificationsNameId();

//get functions.php
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

  case 'add-class':
    // Filter and store the data
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName',FILTER_SANITIZE_FULL_SPECIAL_CHARS));


    // Check for missing data
    if (empty($classificationName)) {
      $message = "<p class=''>Please enter classification name.</p>";
      include '../view/add-classification.php';
      exit;
    }

    $classifLen = strlen($classificationName);
    if ($classifLen > 30) {
      $message = "Classification name is limited to 30 characters";
      include '../view/add-classification.php';
      exit;
    }

    // Send the data to the model
    $addClassResult = addClass($classificationName);

    // Check and report the result
    if ($addClassResult === 1) {
      header("Refresh:0");
      exit;
    } else {
      $message = "<p class=''>Please enter classification name.</p>";
      include '../view/add-classification.php';
      exit;
    }

    break;

  case 'addInv':  
    
    // Filter and store the data
    $classificationId = intval(trim(filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT)));
    $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_URL));
    $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_URL));
    $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_VALIDATE_INT);
    $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    // Check for missing data
   if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) ||
   empty($invColor) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock)
   ) {
      $message = "<p class=''>Please provide information for all empty form fields.</p>";
      include '../view/add-vehicle.php';
      exit;
    }

    // Send the data to the model
    $addVehicleResult = addVehicle($classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);

    // Check and report the result
    if ($addVehicleResult === 1) {
      $message = "<p>" . $invMake . " was successfully added to inventory" . "</p>";
      include '../view/add-vehicle.php';
      exit;
    } else {
      $message = "<p class=''>All fields required</p>";
      include '../view/add-vehicle.php';
      exit;
    }

    break;

  case 'add-classification':
    include '../view/add-classification.php';

    break;


  case 'add-vehicle':
    include '../view/add-vehicle.php';

    break;

  default:
    include '../view/vehicle-management.php';
}
