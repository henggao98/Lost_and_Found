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
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <body>

<div class="logo">
  <b>Lost & Found</b>
</div>

<div class="topnav">
  <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
  <a href="account.php" style="float:right" class="active"><i class="fa fa-fw fa-user"></i>Account</a>
  <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
  <a href="items.php" style="float:right"><i class="fa fa-fw fa-search"></i>Search Items</a>
  <a href="found.php" style="float:right"><i class='fas fa-hand-holding-heart'></i>Found Something</a>
</div>

<div class="row">
  <div class="leftcolumn">
    <div class="card">
      <h3>Account Information:</h3>
      <?php include 'PersonalInformation.php';?>
    </div>
    <div class="card">
      <h3>Comments:</h3>
      <?php include 'accountComments.php';?>
    </div>
  </div>


  <div class="rightcolumn" >
      <h1 align="center" style="color:#EDB100";>Found Items</h1>
      <?php include 'FoundItems.php';?>
      <h1 align="center", style="color:#EDB100;">Matched Items</h1>
      <?php include 'matchedItemsUserFound.php';?>
      <h1 align="center" style="color:#EDB100";>Claimed Items</h1>
      <?php include 'matchedItemsUserLost.php';?>
  </div><!--coloumn-->
 </body>
 </html>

