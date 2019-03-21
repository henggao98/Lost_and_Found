<?php
include_once 'db_connection.php';

// For the sake of testing
session_start();
$_SESSION["id"] = 9;
$_SESSION['loggedIn'] = 1;
//Check that the user is logged in, if not disconnect
if($_SESSION["loggedIn"] == 0)
  {
    echo "You are not logged in";
    $conn->close();
  }//if

// <?php echo htmlspecialchars($_SERVER["PHP_SELF"]);>? for selfsubmitting form

$itemName = $description = $location = $date = "";
$itemNameErr = $descriptionErr = $locationErr = $dateErr = "";
$finderID = $_SESSION["id"];
$countOfSuccessfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */

  // For each item check there has been data entered for it. If there has been
  // data enetered for every requied item then enter the values into the ITEMS??
  // table.

  // The name of the item
  if (empty($_POST["itemName"])) {
    $nameErr = "The type of item is required";
  }
  else if ($_POST['itemName'] == 'other'){
    $itemName = test_input($_POST["nameOther"]);
    $countOfSuccessfulFields ++;
  }
  else
  {
    $itemName = test_input($_POST["itemName"]);
    $countOfSuccessfulFields ++;
  }

  // The description of the item
  if (empty($_POST["description"])) {
    $descriptionErr = "A short description of the item is required";
  } else {
    $description = test_input($_POST["description"]);
    $countOfSuccessfulFields ++;
  }

  // The location of the item
  if (empty($_POST["location"])) {
    $locationErr = "The location of the item is required";
}
    else if ($_POST['location'] == 'other'){
      $location = test_input($_POST["locationOther"]);
      $countOfSuccessfulFields ++;
  } else {
    $location = test_input($_POST["location"]);
    $countOfSuccessfulFields ++;
  }

  // If all required information has been entered, the information is inserted
  // into the database
  if($countOfSuccessfulFields == 3) {
    $insertQuery = "INSERT INTO Items (FinderID, ItemName, Descript, Location, Date)
          VALUES ('{$finderID}', '{$itemName}', '{$description}', '{$location}', NOW())";

    if($conn->query($insertQuery) === TRUE)
      echo "New item added successfully";
    else
      echo "Error1";
  }
  else
    echo "Error2";
}

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
