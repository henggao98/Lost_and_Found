<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2><p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>
</p>
<?php

if($matchedRow["Status"] == 1)
{
?>
  <p><button class="buttonInactive">Not Yet Returned</button></p>
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


