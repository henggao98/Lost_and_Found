<!DOCTYPE html>
<html>
<div class="card">
<?php
  $sql = "SELECT CommentedID, CommenterID, Comment FROM Ratings";
  $commentResult = $conn->query($sql);

  while($commentRow = $commentResult->fetch_assoc())
  {
    if($commentRow["CommentedID"] == $sessionId)
    {

      $sql = "SELECT ID, Name FROM Users";
      $commenterResult = $conn->query($sql);

      while($commenterRow = $commenterResult->fetch_assoc())
      {
        if($commenterRow["ID"] == $commentRow["CommenterID"])
        {
          echo "Comment: " . $commentRow["Comment"];
?><br>
<?php
          echo "From: " . $commenterRow["Name"];
?><br>
<?php
        }
      }
    }
  }
?>
</div>
</html>
