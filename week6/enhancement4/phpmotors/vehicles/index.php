<?php
// Site Main controller

// Get the database connection file
require_once '../library/connections.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the vehicles model
require_once '../model/vehicles-model.php';

// Get the array of classifications
$classifications = getClassifications();
$classificationsNameId = getClassificationsNameId();

$navList = '<ul>';
$navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
}
$navList .= '</ul>';

$classificationDDL = '<label for="carclassificationId" class="required">Choose Car Classification</label><br>';
$classificationDDL .= '<select name="classificationId" id="carclassificationId">';
$classificationDDL .= '<option disabled selected value> -- select classification -- </option>';

foreach ($classificationsNameId as $classificationNameId) {
  $classificationDDL .= "<option value='$classificationNameId[classificationId]'>$classificationNameId[classificationName]</option>";
}
$classificationDDL .= '</select>';


$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
}

switch ($action) {
  case 'error':
    include '../view/500.php';
    break;

  case 'add-class':
    // Filter and store the data
    $classificationName = filter_input(INPUT_POST, 'classificationName');


    // Check for missing data
    if (empty($classificationName)) {
      $message = "<p class=''>Please enter classification name.</p>";
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
    $classificationId = filter_input(INPUT_POST, 'classificationId');
    $invMake = filter_input(INPUT_POST, 'invMake');
    $invModel = filter_input(INPUT_POST, 'invModel');
    $invDescription = filter_input(INPUT_POST, 'invDescription');
    $invImage = filter_input(INPUT_POST, 'invImage');
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
    $invPrice = filter_input(INPUT_POST, 'invPrice');
    $invStock = filter_input(INPUT_POST, 'invStock');
    $invColor = filter_input(INPUT_POST, 'invColor');

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
