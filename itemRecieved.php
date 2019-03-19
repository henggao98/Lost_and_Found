<?php
  include_once "db_connection.php";

  $itemID = $_GET['itemID'];
  $matchedID = $_GET['matchedID'];

  $sqlItem = "DELETE FROM Items WHERE ID = $itemID";
  $conn->query($sqlItem);
  $sqlMatched = "DELETE FROM Matched WHERE ID = $matchedID";
  $conn->query($sqlMatched);
  header("Location: account.php");
?>

