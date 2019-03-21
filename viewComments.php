<?php
  include_once "db_connection.php";
  session_start();

  if(!isset($_SESSION["loggedIn"]))
    header("Location: index.php");
  else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    header("Location: index.php");
?>

<!DOCTYPE html>

  <html>
  <title>Comments Page</title>
  <head><link rel="stylesheet" href="items.css"></head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <body>

  <div class="logo">
    <b> Lost & Found </b>
  </div>

  <div class="topnav">
    <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="account.php" style="float:right"><i class="fa fa-fw fa-user"></i>Account</a>
    <a href="items.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Items</a>
    <a href="about.html" style="float:right"><i class="fa fa-fw fa-info-circle"></i>About</a>
    <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
  </div>

<div class="card">
<h2>Comments: </h2>
<div class="card2">
<?php
  $id = $_GET["id"];

  $sqlComment = "SELECT * FROM Ratings";
  $commentResult = $conn->query($sqlComment);
  $noOfComments = 0;

  while($commentRow = $commentResult->fetch_assoc())
  {
    if($commentRow["CommentedID"] == $id) 
    {
      $sql = "SELECT ID, Name FROM Users";
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc())
      {
        if($row["ID"] == $commentRow["CommenterID"])
        {
?>
          <div class="card">
          <h4><?php echo "Comment:" . $commentRow["Comment"]; ?></h4><br>
          <h4><?php echo "Commented by: " . $row["Name"]; ?></h4><br>
          </div>
<?php
          $noOfComments++;
        }//if
      }//while
    }//if
  }//while

  if($noOfComments == 0)
    echo "This user has no comments";
?>
</div>
</div>
