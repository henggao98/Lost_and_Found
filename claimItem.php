<?php
include_once "db_connection.php";

if(isset($_GET["itemID"]) && isset($_GET["mislayerID"]))
{
  $itemID = $_GET["itemID"];
  $mislayerID = $_GET["mislayerID"];

  $itemSQL = "SELECT * FROM Items WHERE ID='$itemID'";
  $itemResult = $conn->query($itemSQL);
  $itemRow = $itemResult->fetch_assoc();

  $finderID = $itemRow["FinderID"];

  $mislayerSQL = "SELECT * FROM Users WHERE ID='$mislayerID'";
  $mislayerResult = $conn->query($mislayerSQL);
  $mislayerRow = $mislayerResult->fetch_assoc();

  $finderSQL = "SELECT * FROM Users WHERE ID='$finderID'";
  $finderResult = $conn->query($finderSQL);
  $finderRow = $finderResult->fetch_assoc();

  $matchedSQL = "SELECT * FROM Matched WHERE FinderID='$finderID' AND MislayerID='$mislayerID' AND  ItemID='$itemID' ";
  $matchedResult = $conn->query($matchedSQL);
  $isInDB = false;
  if($matchedResult->num_rows == 0)
  {
    $insertSQL = "INSERT INTO Matched (FinderID, MislayerID, ItemID, Status) VALUES ('$finderID', '$mislayerID', '$itemID', '0') ";
    if($conn->query($insertSQL) === TRUE)
    {
      echo "New row added";
      $msg = "The " . $itemRow["ItemName"] . " lost on " . $itemRow["Date"] . " around " . $itemRow["Location"] . " received a match by " . $mislayerRow["Name"] . ". In order to come in contact with the mislayer please email " . $mislayerRow["Email"] . ".";
      mail($finderRow["Email"], "Lost & Found: Matched case", $msg);
      //echo $msg;
    }
    else
      echo "Problem with inserting";

  }
  else
  {
    echo "Row already added"; 
  }
  header("Location: items.php");
}
else
  header("Location: items.php");


?>