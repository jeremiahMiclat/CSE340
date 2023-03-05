<?php
// Site Main controller

// Create or access a Session
session_start();


//check user level or not logged in
//if (!isset($_SESSION['loggedin']) || !($_SESSION['clientData']['clientLevel'] > 1)) {
  //header('Location: /phpmotors/');
//}

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
    $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));


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
    if (
      empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) ||
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


  case 'getInventoryItems':
    // Get the classificationId 
    $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    // Fetch the vehicles by classificationId from the DB 
    $inventoryArray = getInventoryByClassification($classificationId);
    // Convert the array to a JSON object and send it back 
    echo json_encode($inventoryArray);
    break;

  case 'mod':

    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = 'Sorry, no vehicle information could be found.';
    }
    include '../view/vehicle-update.php';
    break;

  case 'updateVehicle':
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
    $classificationId = filter_input(INPUT_POST, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invDescription = filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invImage = filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invThumbnail = filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invPrice = filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $invStock = filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_NUMBER_INT);
    $invColor = filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    if (empty($classificationId) || empty($invMake) || empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail) || empty($invPrice) || empty($invStock) || empty($invColor)) {
      $message = '<br><p>Please complete all information for the updated item! Double check the classification of the item.</p>';
      include '../view/vehicle-update.php';
      exit;
    }
    $updateResult = updateVehicle($invId, $classificationId, $invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invStock, $invColor);
    if ($updateResult) {
      $message = "<br><p class=''>Congratulations, the $invMake $invModel was successfully updated.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<br><p>Error. $invMake $invModel was not updated.</p>";
      include '../view/vehicle-update.php';
      exit;
    }
    break;

  case 'del':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
    $invInfo = getInvItemInfo($invId);
    if (count($invInfo) < 1) {
      $message = "<br><p>Sorry, no vehicle information could be found.</p>";
    }
    include '../view/vehicle-delete.php';
    exit;
    break;

  case 'deleteVehicle':
    $invMake = filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invModel = filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

    $deleteResult = deleteVehicle($invId);
    if ($deleteResult) {
      $message = "<br><p class='notice'>Congratulations the, $invMake $invModel was	successfully deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    } else {
      $message = "<br><p class='notice'>Error: $invMake $invModel was not
        deleted.</p>";
      $_SESSION['message'] = $message;
      header('location: /phpmotors/vehicles/');
      exit;
    }
    break;

  case 'classification':
    $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicles = getVehiclesByClassification($classificationName);
    if (!count($vehicles)) {
      $message = "<br><p class=''>Sorry, no $classificationName could be found.</p>";
      $_SESSION['message'] = $message;
    } else {
      $vehicleDisplay = buildVehiclesDisplay($vehicles);
    }

    include '../view/classification.php';

    break;

  case 'vehicle':
    $invId = filter_input(INPUT_GET, 'invId', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $vehicleDetail = getInvItemInfo($invId);
    if (!count($vehicleDetail)) {
      $message = "<p class=''>Sorry, no matching vehicle could be found.</p>";
      $_SESSION['message'] = $message;
    } else {
      $vehicleDisplay = buildVehicleDetailsDisplay($vehicleDetail);
    }

    include '../view/vehicle-detail.php';

    break;

  default:
    $classificationList = buildClassificationList($classificationsNameId);
    include '../view/vehicle-management.php';
}
