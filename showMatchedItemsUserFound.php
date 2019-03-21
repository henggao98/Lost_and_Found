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



<!Allen you need to make this button call the function itemReturned with the argument as
matchedRow["ID"]>

<?php

if($matchedRow["Status"] == 1)
{
?>
  <p><button class="buttonInacvtive" disabled>Waiting for owners confirmation</button></p>;
<?php
}
elseif ($matchedRow["Status"] == 0)
{
?>
<p><button class="button" onclick="location.href='itemReturned.php?matchedID=<?php echo($matchedRow["ID"]);?>'">Returned To Owner</button></p>
<?php
}
?>
</div>
