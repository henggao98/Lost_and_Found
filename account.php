<?php 
  include_once "db_connection.php"; 
  session_start();
?>
<!DOCTYPE html>


  <html>
  <title>Account Page</title>
  <head><link rel="stylesheet" href= "account.css">
  <meta charset="utf-8">

 </head>


 <body>

  <div class="header">
    <b>Lost & Found</b>
  </div>

<nav class="topnav">
  <a class="active" href="#news">About</a>
  <a class="active" href ="#home">Home</a>

  <form>
    <input type="text" name="search" placeholder="Search..">
  </form>
</nav>

<div class="row"><!--genericContainer-->
  <div class="side"><!--left column-->
    <div class="PersonalInformationContainer">
      <h2 class="subtitle">Personal Information</h2>
      <?php include 'PersonalInformation.php';?>
    </div>
  </div>

  <div class="main" >
    <div class="MatchedItemContainer">
      <h2 class="subtitle">Matched Items</h2>
      <br>
      <?php include 'MatchedItems.php';?>
    </div>
    <br>


    <div class="FoundItemsContainer">
      <h2 class="subtitle">Found Items</h2>
      <br>
      <?php include 'FoundItems.php';?>
    </div>
    <br>


    <div>
      <button class="button">Leave a message</button>
    </div>

  </div>  <!--end main-->
</div><!--coloumn-->



 </body>
 </html>
