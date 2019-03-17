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

  $matchedFinderSQL = "SELECT * FROM Matched WHERE FinderID='$userID' AND  ItemID='$itemID' ";
  $matchedFinderResult = $conn->query($matchedFinderSQL);

  $matchedMislayerSQL = "SELECT * FROM Matched WHERE MislayerID='$userID' AND  ItemID='$itemID' ";
  $matchedMislayerResult = $conn->query($matchedMislayerSQL);

  if($itemID == $user)
  {
  ?>
    <h3> This item is posted by you.</h3>>
  <?php
  }
  elseif($matchedMislayerResult->num_rows > 0)
  {
  ?>
    <h3> This item has already been claimed by you. </h3>
  <?php
  }
  else
  {
  ?>
    <div>
      <a href="claimItem.php?itemID=<?php echo($row['ID']); ?>&mislayerID=<?php echo($_SESSION['id']); ?>">Claim Item</a>
    </div>
  <?php
  }
}
?>
</div>