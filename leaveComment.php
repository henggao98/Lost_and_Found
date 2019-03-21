<?php 
  include 'db_connection.php';
  session_start();

  if(isset($_GET["matchedRow"]) && isset($_GET['itemID']) && isset($_GET['CommenterID']) && isset($_GET['CommentedID']) && $_GET['CommenterID'] == $_SESSION["id"] && !empty($_POST["textArea"]))
  {
    $matchedRow = $_GET["matchedRow"];
    $itemID = $_GET["itemID"];
    $commenterID = $_GET['CommenterID'];
    $commentedID = $_GET['CommentedID'];
    //$rating
    $comment = test_input($_POST["textArea"]);
    $commentInsertQuery = "INSERT INTO Ratings (CommenterID, CommentedID, Rating, Comment) VALUES ('{$commenterID}', '{$commentedID}', '3', '{$comment}')";

    if($conn->query($commentInsertQuery) === TRUE)
    {
      header("Location: itemRecieved.php?itemID=" . $itemID . "&matchedID=" . $matchedRow);
    }
    else
    {
      echo "Insert Error";
    }
  }
  else
    echo "Get variables Error";

  function test_input($data) {
  $data = trim($data);
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>  