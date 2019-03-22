
<?php
  $sql = "SELECT CommentedID, CommenterID, Comment FROM Ratings";
  $commentResult = $conn->query($sql);

  while($commentRow = $commentResult->fetch_assoc())
  {
    if($commentRow["CommentedID"] == $sessionId)
    {

      $sql = "SELECT ID, Name, Rating FROM Users";
      $commenterResult = $conn->query($sql);

      while($commenterRow = $commenterResult->fetch_assoc())
      {
        if($commenterRow["ID"] == $commentRow["CommenterID"])
        {
?>
        <p><h4><a href="viewComments.php?id=<?php echo($commenterRow["ID"]) ?>" style="color:#EDB100">
<?php
  echo $commenterRow["Name"];
?>
</a>
</h4>
<?php
    $stars = round($commenterRow["Rating"]);
    for($index = 0; $index < $stars; $index++)
    {
    ?>
      <span class = "fa fa-star checked"></span>
    <?php } ?>
    <?php
    for($index = 0; $index < (5 - $stars); $index++)
    { ?>
      <span class = "fa fa-star"></span>
    <?php
    }
    echo '(' . round($commenterRow["Rating"], 1) . ')';
    ?>
  </p>

<p><?php
          echo $commentRow["Comment"];
?>
</p>
<?php
        }
      }
    }
  }
?>
