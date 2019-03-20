<?php
  session_start();
  if(!isset($_SESSION["loggedIn"]))
    header("Location: index.php");
  else if(isset($_SESSIOIN["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    header("Location: index.php");

  include_once "db_connection.php";
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

  <div class="topnav">
    <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="account.php" style="float:right"><i class="fa fa-fw fa-user"></i>Account</a>
    <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
    <form name="searchForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="text" name="search" placeholder="Search.." value="<?php echo($_SESSION['search']); ?>">
      <input type="submit"
         style="position: absolute; left: -9999px; width: 1px; height: 1px;"
         tabindex="-1"  name="submitSearch" value="<?php echo $searched; ?>" />
    </form>
  </div>

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
