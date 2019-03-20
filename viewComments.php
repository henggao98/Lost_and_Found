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
  <head><link rel="stylesheet" href="account.css"></head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <body>

  <div class="logo">
    <b> Lost & Found </b>
  </div>

  <div class="topnav">
    <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="account.php" style="float:right"><i class="fa fa-fw fa-user"></i>Account</a>
    <a href="about.html" style="float:right"><i class="fa fa-fw fa-info-circle"></i>About</a>
    <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
  </div>

<?php
  $commentedID = $_GET["id"];

  $sqlComment = "SELECT * FROM Ratings";
  $commentResult = $conn->query($sqlComment);

  while($commentRow = $commentResult->fetch_assoc())
  {
    if($commentRow["CommentedID"] == $commentedID) 
    {
      $sql = "SELECT ID, Name FROM Users";
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc())
      {
        if($row["ID"] == $commentRow["CommenterID"])
        {
          echo "Comment:" . $commentRow["Comment"];
          echo "Commented by: " . $row["Name"];
        }//if
      }//while
    }//if
  }//while
?>
