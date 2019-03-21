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
  <meta name="viewport" content="width=device-width, initial-scale=1">

 </head>


 <body>

  <div class="header">
    <b>Lost & Found</b>
  </div>

  <nav class="topnav">
    <a href="index.php" style="float:right">Home</a>
    <a href="account.php" style="float:right"><i class="fa fa-fw fa-user"></i>Account</a>
    <a href="about.html" style="float:right"><i class="fa fa-fw fa-info-circle"></i>About</a>
    <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
    <form name="searchForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
      <input type="text" name="search" placeholder="Search.." value="<?php echo($_SESSION['search']); ?>">
      <input type="submit"
         style="position: absolute; left: -9999px; width: 1px; height: 1px;"
         tabindex="-1"  name="submitSearch" value="<?php echo $searched; ?>" />
    </form>
  </nav>




<div class="row"><!--genericContainer-->
  <div class="side"><!--left column-->
    <div class="PersonalInformationContainer">
      <h2 class="subtitle">Account Information</h2>
      <?php include 'PersonalInformation.php';?>
    </div>
  </div>

  <div class="main" >
    <div class="MatchedItemContainer">
      <h2 class="subtitle">Matched Items</h2>
      <br>
        <div class="rightColumnGrid">
          <h4 class="subtitle">Items you've found</h4>
          <?php include 'matchedItemsUserFound.php';?>
        </div>
        <br>
        <div class="rightcolumnGrid">
          <h3 class="subtitle">Item's you've lost</h3>
          <?php include 'matchedItemsUserLost.php';?>
        </div>
    </div>
    <br>


    <div class="FoundItemsContainer">
      <h2 class="subtitle">Found Items</h2>
      <br>
      <?php include 'FoundItems.php';?>
    </div>
    <br>

  </div>  <!--end main-->
</div><!--coloumn-->

<div class="footer"><center><a href="privacy.html"> Privacy Policy </a> --- <a href="terms.html"> Terms of use</a></center></div>

 </body>
 </html>
