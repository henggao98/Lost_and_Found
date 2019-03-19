<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2><p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>
</p>

<! When this button is pressed call the recievedItem function with $row["ItemID"] as the 
argument>

<input type="button" value ="Recieved from Finder" <?php if($matchedRow["Status"] == '0'){ ?> disabled <?php } ?>
</div>
