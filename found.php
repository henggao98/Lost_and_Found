<?php
$servername = "dbhost.cs.man.ac.uk";
$username = "j78532kt";
$password = "kaloyandb";
$dbname = "2018_comp10120_z8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$finderID = $itemName = $description = $location = $date = "";
$finderIDErr = $itemNameErr = $descriptionErr = $locationErr = $dateErr = "";
$countOfSuccesfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  if (empty($_POST["itemName"])) {
    $nameErr = "The type of item is required";
  } else {
    $name = test_input($_POST["itemName"]);
    $_SESSION["itemName"] = $itemName;
    $countOfSuccesfulFields ++;
  }

$sql = "INSERT INTO Items (FinderID, ItemName, Descript, Location, Date)
VALUES (     )";

?>
