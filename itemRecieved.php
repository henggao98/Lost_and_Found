<?php
  include_once "db_connection.php";
  session_start();

  if(isset($_GET['itemID']) && isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == 1)
  {

    $userID = $_SESSION["id"];
    $itemID = test_input($_GET['itemID']);


    $checkQuerry = "SELECT * FROM Matched WHERE MislayerID='$userID' AND ItemID='$itemID'";
    $checkResult = $conn->query($checkQuerry);
    
    if($checkResult->num_rows > 0)
    {
      $sqlItem = "DELETE FROM Items WHERE ID = $itemID";
      $conn->query($sqlItem);
      $sqlMatched = "DELETE FROM Matched WHERE ItemID = $itemID";
      $conn->query($sqlMatched);
      header("Location: account.php");
    }
  }

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

