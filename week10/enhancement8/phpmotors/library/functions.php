<?php

//checks email input
function checkEmail($clientEmail)
{
    $valEmail = filter_var($clientEmail, FILTER_VALIDATE_EMAIL);
    return $valEmail;
}





// Check the password for a minimum of 8 characters,
// at least one 1 capital letter, at least 1 number and
// at least 1 special character
function checkPassword($clientPassword)
{
    $pattern = '/^(?=.*[[:digit:]])(?=.*[[:punct:]\s])(?=.*[A-Z])(?=.*[a-z])(?:.{8,})$/';
    return preg_match($pattern, $clientPassword);
}


//car classification array to set navList variable
function setNavList($classificationsArray)
{
    $navList = '<ul>';
    $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
    foreach ($classificationsArray as $classification) {
        $navList .= "<li><a href='/phpmotors/vehicles/?action=classification&classificationName=" . urlencode($classification['classificationName']) . "' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
    }
    $navList .= '</ul>';
    return $navList;
}

// Build the classifications select list 
function buildClassificationList($classifications)
{
    $classificationList = '<label class="" for="classificationList">Choose a Classification</label>';
    $classificationList .= '<select class="" name="classificationId" id="classificationList">';
    $classificationList .= "<option>Choose a Classification</option>";
    foreach ($classifications as $classification) {
        $classificationList .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
    }
    $classificationList .= '</select>';
    return $classificationList;
}


function buildVehiclesDisplay($vehicles)
{
    $dv = '<ul id="inv-display">';
    foreach ($vehicles as $vehicle) {
        $dv .= '<li>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=" . urlencode($vehicle['invId']) . "' title='View our $vehicle[invMake] $vehicle[invModel]'>" . "<img src='$vehicle[invThumbnail]' alt='Image of $vehicle[invMake] $vehicle[invModel] on phpmotors.com'></a>";
        $dv .= '<hr>';
        $dv .= "<a href='/phpmotors/vehicles/?action=vehicle&invId=" . urlencode($vehicle['invId']) . "' title='View our $vehicle[invMake] $vehicle[invModel]'>";
        $dv .= "<h2>$vehicle[invMake] $vehicle[invModel]</h2></a>";
        $dv .= "<span class='currSign'>" .number_format($vehicle['invPrice']) . "</span>";
        $dv .= '</li>';
    }
    $dv .= '</ul>';
    return $dv;
}

function buildVehicleDetailsDisplay($vehicle)
{
    $dv = "<div><img alt='" . $vehicle['invMake'] . " " . $vehicle['invModel'] . "'" . " src='" . $vehicle['invImage'] . "'>  <p class='margin0'>Price: " . "<span class='currSign'>" . number_format($vehicle['invPrice']) . "</span>" . "</p></div>";
    $dv .= "<div>
    <h2>" . $vehicle['invMake'] . " " . $vehicle['invModel'] . " Details:" . "</h2>";
    $dv .= "<div class='vehicleDescription'><p class='top10px'>" . $vehicle['invDescription'] . "</p>";
    $dv .= "<p class='top10px'>Color: " . $vehicle['invColor'] . "</p>";
    $dv .= "<p class='top10px'>In stock: " . $vehicle['invStock'] . "</p></div>";
    $dv .= "</div>";

    return $dv;
}
