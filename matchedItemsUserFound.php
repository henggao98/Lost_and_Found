<?php
//Select any matched items, this user has found and display them

  $matchedItems = 0;
  $sql = "SELECT * FROM Matched";
  $matchedResult = $conn->query($sql);


  while($matchedRow = $matchedResult->fetch_assoc())
  {
    if($matchedRow["FinderID"] == $sessionId)
    {
      $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
      $itemsResult = $conn->query($sql);

      while($row = $itemsResult->fetch_assoc())
      {
        if($row["ID"] == $matchedRow["ItemID"])
        {
          $displayId = $matchedRow["MislayerID"];
          $sqlDisplay = "SELECT Name, isInstitution FROM Users WHERE ID = '$displayId'";
          $displayResult = $conn->query($sqlDisplay);
          $dRow = mysqli_fetch_assoc($displayResult);

          $matchedItems++;
          //update the number label of the item.

          include "showMatchedItemsUserFound.php";
        }//if
      }//while
    }//if
  }//while

  if($matchedItems == 0)
  {
    echo "You have no matched items <br><br>";
  }//if
?>
