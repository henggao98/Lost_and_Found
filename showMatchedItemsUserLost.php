<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2><p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>
</p>

<! When this button is pressed call the recievedItem function with $row["ItemID"] as the 
argument>

<?php
$itemUSerID = $row['ID']; // SORRY FOR THIS VARIABLE
$USerID = $_SESSION["name"];
if($matchedRow["Status"] == 1)
{
?>

<button class="button" onclick="document.getElementById('<?php echo($itemUSerID) ?>').classList.toggle('show');">Recieved from Finder</button>

<div class="formPopup" id="<?php echo($itemUSerID) ?>">
  <form action="leaveComment.php?CommenterID=<?php echo(arg1) ?>&CommentedID=<?php echo(arg1) ?>" class="formContainer" method="POST">

    <textarea name="textArea" required></textarea><br>
    
    <button class="button" onclick="location.href='itemRecieved.php?itemID=<?php echo($row["ID"]) ?> &  matchedID = <?php echo($matchedRow["ID"])?>'" >Don't Leave Comment</button>

    <input type="submit" name="submitButton" class="button">

  </form>
</div>


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
