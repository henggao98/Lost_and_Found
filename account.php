<?php
  session_start();
  if(!isset($_SESSION["loggedIn"]))
    header("Location: index.php");
  else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    header("Location: index.php");
  else if($_SESSION["loggedIn"] == 1 && isset($_SESSION["loggedIn"]))
    $loggedIn = true;

  include_once "db_connection.php";
?>
<!DOCTYPE html>


  <html>
  <title>Account Page</title>
  <head><link rel="stylesheet" href= "account.css">
  <meta charset="utf-8">

  </head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <body>

<div class="logo">
  <b>Lost & Found</b>
</div>

<div class="topnav">
  <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
  <a href="items.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Items</a>
  <a href="about.html" style="float:right"><i class="fa fa-fw fa-info-circle"></i>About</a>
  <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h3>Account Information:</h3>
      <?php include 'PersonalInformation.php';?>
    </div>
    <div class="card">
      <h2>Comments:</h2>
      <?php include 'accountComments.php';?>
    </div>
  </div>


  <div class="rightcolumn" >
    <div class="card">
    <h1 align="center", style="color:#EDB100;">Matched Items</h1>
      <br>
      <div class="card">
      <h2>Items you've found</h2>
      <?php include 'matchedItemsUserFound.php';?>
      </div>
      <br>
      <div class="card">
      <h2 class="subtitle">Item's you've lost</h2>
      <?php include 'matchedItemsUserLost.php';?>
      </div>
      <div class="card">
      <h1 align="center", style="color:#EDB100";">Found Items</h1>
      <br>
      <?php include 'FoundItems.php';?>
      </div>
  </div><!--coloumn-->
 </body>
 </html>

