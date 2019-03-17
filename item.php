<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2><p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>  
</p>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1)
{
  $itemID = $row['ID'];

  $matchedMislayerSQL = "SELECT * FROM Matched WHERE MislayerID='$userID' AND  ItemID='$itemID' ";
  $matchedMislayerResult = $conn->query($matchedMislayerSQL);

  if($itemID == $userID)
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