<?php
//Select any matched items and display them

  $matchedItems = 0;
  $sql = "SELECT FinderID, MislayerID, ItemID FROM Matched";
  $matchedResult = $conn->query($sql);


  while($matchedRow = $matchedResult->fetch_assoc())
  {
    if($matchedRow["MislayerID"] == $sessionId || $matchedRow["FinderID"] == $sessionId)
    {
      $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
      $itemsResult = $conn->query($sql);

      while($row = $itemsResult->fetch_assoc())
      {
        if($row["ID"] == $matchedRow["ItemID"])
        {
          $matchedItems++;
          echo "<h3>Matched Item: " . $matchedItems . "</h3><br>";
          //update the number label of the item.

          include "itemWithoutClaim.php";
        }//if
      }//while
    }//if
  }//while

  if($matchedItems == 0)
  {
    echo "You have no matched items <br><br>";
  }//if
?>
