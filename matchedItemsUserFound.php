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
          $matchedItems++;
          //update the number label of the item.

          include "showMatchedItemsUserFound.php";
        }//if
      }//while
    }//if
  }//while

  if($matchedItems == 0)
  {
    echo "<p class="noMatchedMessage">You have no matched items </p><br>";
  }//if
?>
