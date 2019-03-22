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
  <form action="leaveComment.php?CommenterID=<?php echo($USerID) ?>&CommentedID=<?php echo($itemUSerID) ?>&itemID=<?php echo($row['ID']) ?>" class="formContainer" method="POST">

    <div class="rate">
      <b>Rate and Comment the Finder: </b>
      <br>
    <input type="radio" id="<?php echo($itemUSerID . "star5") ?>" name="rate" value="5" />
    <label for="<?php echo($itemUSerID . "star5") ?>" title="text">5 stars</label>
    <input type="radio" id="<?php echo($itemUSerID . "star4") ?>" name="rate" value="4" />
    <label for="<?php echo($itemUSerID . "star4") ?>" title="text">4 stars</label>
    <input type="radio" id="<?php echo($itemUSerID . "star3") ?>" name="rate" value="3" />
    <label for="<?php echo($itemUSerID . "star3") ?>" title="text">3 stars</label>
    <input type="radio" id="<?php echo($itemUSerID . "star2") ?>" name="rate" value="2" />
    <label for="<?php echo($itemUSerID . "star2") ?>" title="text">2 stars</label>
    <input type="radio" id="<?php echo($itemUSerID . "star1") ?>" name="rate" value="1" />
    <label for="<?php echo($itemUSerID . "star1") ?>" title="text">1 star</label>
    </div><br>

    <textarea name="textArea" placeholder="Leave a comment..." required></textarea><br>
    
    <button class="button" onclick="location.href='itemRecieved.php?itemID=<?php echo($row["ID"]) ?> &  matchedID = <?php echo($matchedRow["ID"])?>'" >Don't Leave Comment</button>

    <input type="submit" name="submitButton" class="button">

  </form>
</div>


<?php
}
else
{
?>
  <button class="buttonInactive">Not Yet Returned</button>
<?php
}
?>
</div>
