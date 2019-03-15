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
  ?>
<div>
  <a href="claimItem.php?itemID=<?php echo($row['ID']); ?>&mislayerID=<?php echo($_SESSION['id']); ?>">Claim Item</a>
</div>
  <?php
  }
?>
</div>