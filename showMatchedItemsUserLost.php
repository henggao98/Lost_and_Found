<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2>
<?php
  if($dRow["isInstitution"] == 1)
    $found = "Found In ";
  else
    $found = "Found By ";
?>
    <h4 style="float:right"><?php echo($found) ?><a href="viewComments.php?id=<?php echo($row["FinderID"]) ?>" style="color:#EDB100">
    <?php
      echo $dRow["Name"];
    ?>
  </a></h4>
<h4>
<p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>
</p>
<p>

<! When this button is pressed call the recievedItem function with $row["ItemID"] as the 
argument>

<?php
if($matchedRow["Status"] == 1)
{
  $itemUSerID = $row["FinderID"]; // SORRY FOR THIS VARIABLE
  $USerID = $_SESSION["id"];
?>

<button class="button" onclick="document.getElementById('<?php echo("popup" . $itemUSerID) ?>').classList.toggle('show');">Recieved from Finder</button>

<div class="formPopup" id="<?php echo("popup" . $itemUSerID) ?>">
  <button class="button" onclick="document.getElementById('<?php echo("popup" . $itemUSerID) ?>').classList.toggle('show');">X</button>
  <form action="leaveComment.php?CommenterID=<?php echo($USerID) ?>&CommentedID=<?php echo($itemUSerID) ?>&itemID=<?php echo($row['ID']) ?>&matchedRow=<?php echo($matchedRow['ID']) ?>" class="formContainer" method="POST">


    <textarea name="textArea" placeholder="Leave a comment..." required></textarea><br>
    
    <button class="button" onclick="location.href='itemRecieved.php?itemID=<?php echo($row["ID"]) ?> &  matchedID = <?php echo($matchedRow["ID"])?>'" >Don't Leave Comment</button>

    <input type="submit" name="submitButton" class="button">

  </form>
</div>


<?php
}
else
{
}
?>
</div>
