<?php
//Select any relevant found items on the site and display it's information

  $foundItems = 0;
  $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
  $itemsResult = $conn->query($sql);
  $loggedIn = true;

  while($itemsRow = $itemsResult->fetch_assoc())
  {
    if($itemsRow["FinderId"] == $sessionId)
    {
      $foundItems++;
      include "showFoundItems.php";
    }//if
  }//while

  if($foundItems == 0)
    echo "You haven't found anything";
?>
