<div class="card">
<h2>
  <?php echo $row["ItemName"]; ?>
</h2>

<?php if($loggedIn){ ?>
<p>
  <h4 style="float:right">Found by <a href="viewComments.php?id=<?php echo($userID) ?>" style="color:#EDB100">
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

<! When this button is pressed call the recievedItem function with $row["ItemID"] as the
argument>

<?php
if($matchedRow["Status"] == 1)
{
?>
<p><button class="button" onclick="location.href='itemRecieved.php?itemID=<?php echo($row["ID"]) ?> &  matchedID = <?php echo($matchedRow["ID"])?>'">Recieved from Finder</button></p>
<?php
}
else
{
?>
<p><button class="buttonInactive" disabled>Awaiting confirmation from finder</button></p>
<?php
}
?>
</div>
