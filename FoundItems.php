<?php
//Select any relevant found items on the site and display it's information

  $foundItems = 0;
  $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
  $itemsResult = $conn->query($sql);


  while($itemsRow = $itemsResult->fetch_assoc())
  {
    if($itemsRow["FinderId"] == $sessionId)
    {
      $isMatched = false;
      $sql = "SELECT FinderID, MislayerID, ItemID FROM Matched";
      $matchedResult = $conn->query($sql);

      while($matchedRow = $matchedResult->fetch_assoc())
      {
        if($matchedRow["FinderID"] == $sessionId && $matchedRow["ItemID"] == $itemsRow["ID"])
        {
          $isMatched = true;
        }//if
      }//while

      if(!$isMatched)
      {
        $foundItems++;
        echo "<h3>Found Item:  " . $foundItems .
         "</h3><br>";//put a No.label on each item in sequence.
        include "item.php";
      }//if
    }//if
  }//while

  if($foundItems == 0)
    echo "You haven't found anything";
?>
