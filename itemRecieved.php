<?php
  include_once "db_connection.php";
  session_start();

  if(isset($_GET['itemID']) && isset($_GET['matchedID']))
  {

    $itemID = $_GET['itemID'];
    $matchedID = $_GET['matchedID'];

    $checkQuerry = "SELECT MislayerID FROM Matched WHERE "

    $sqlItem = "DELETE FROM Items WHERE ID = $itemID";
    $conn->query($sqlItem);
    $sqlMatched = "DELETE FROM Matched WHERE ID = $matchedID";
    $conn->query($sqlMatched);
    header("Location: account.php");
  }
?>

