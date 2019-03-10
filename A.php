<?php include 'loginState.php'; ?>
  <!DOCTYPE html>


  <html>
  <title>Account Page</title>
  <head><link rel="stylesheet" href= "account.css">
  <meta charset="utf-8">

 </head>


 <body>

  <div class="header">
    <h1>Lost & Found</h1>
  </div>

<nav class="topnav">
  <a class="active" href="#news">About</a>
  <a class="active" href ="#home">Home</a>

  <form>
    <input type="text" name="search" placeholder="Search..">
  </form>
</nav>

<div class="row">
  <div class="side">
          <div class="PI">
          <h2 class="subtitle">Personal Information</h2>
           <?php include 'PersonalInformation.php';?>
          </div>


  <div class="main" >
    <div>
      <h2 class="subtitle">Matched Items</h2>
      <br>
      <?php include 'MatchedItems.php';?>
    </div>
    <br>


    <div>
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
