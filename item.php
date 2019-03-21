<?php
/*
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
*/

if($loggedIn)
{
  $itemID = $row['ID'];
  $itemFinderID = $row['FinderID'];

  $matchedMislayerSQL = "SELECT * FROM Matched WHERE MislayerID='$userID' AND  ItemID='$itemID' ";
  $matchedMislayerResult = $conn->query($matchedMislayerSQL);

  $finderSQL = "SELECT Name, ID, isInstitution FROM Users WHERE ID='$itemFinderID'";
  $finderResult = $conn->query($finderSQL);
  $finderRow = $finderResult->fetch_assoc();
}
?>
<div class="card">
<h2>
  <?php echo $row["ItemName"]; ?>
</h2>

<?php if($loggedIn){ ?>
<p>
  <h4 style="float:right">
    <?php 
      if( $finderRow['isInstitution'] == '1') echo "Found In";
      else echo "Found by";
     ?>
    <a href="viewComments.php?id=<?php echo($finderRow["ID"]) ?>" style="color:#EDB100">
    <?php
    echo $finderRow["Name"];
    ?>
  </a></h4>
</p>  
<?php } ?>

<p class="outset"><h4>
  <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p>

<p>
<?php echo $row["Descript"]; ?>  
</p>

<?php

if($loggedIn)
{
  if($itemFinderID == $userID)
  {
  ?>
    <p><button class="buttonInactive" disabled>Item posted by you</button></p>
  <?php
  }
  elseif($matchedMislayerResult->num_rows > 0)
  {
  ?>
      <p><button class="buttonInactive" disabled>Claimed Item</button></p>
  <?php
  }
  else
  {
  ?>
      <p><button class="button" onclick="location.href='claimItem.php?itemID=<?php echo($itemID); ?>&mislayerID=<?php echo($userID); ?>' " >Claim Item</button></p>

  <?php
  }
}
?>
</div>
