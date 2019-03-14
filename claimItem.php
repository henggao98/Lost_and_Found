<?php
include_once "db_connection.php";

if(isset($_GET["itemID"]) && isset($_GET["mislayerID"]))
{
  $itemID = $_GET["itemID"];
  $mislayerID = $_GET["mislayerID"];

  $itemSQL = "SELECT * FROM Items WHERE ID='$itemID'";
  $itemResult = $conn->query($itemSQL);
  $itemRow = $itemResult->fetch_assoc();

  




}
else
  header("Location: items.php");


?>