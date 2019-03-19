<?php
  session_start();
  if(!isset($_SESSION["loggedIn"]))
    header("Location: index.php");
  else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
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
      <h2 class="subtitle">Account Information</h2>
      <?php include 'PersonalInformation.php';?>
    </div>
  </div>

  <div class="main" >
    <div class="MatchedItemContainer">
      <h2 class="subtitle">Matched Items</h2>
      <br>
        <div class="rightcolumn">
          <h4 class="subtitle">Items you've found</h4>
          <?php include 'matchedItemsUserFound.php';?>
        </div>
        <br>
        <div class="rightcolumn">
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



 </body>
 </html>

<?php
function itemReturned($id)
{
  $sql = "UPDATE Matched SET Status = '1' WHERE Matched . ID = $id";
}

function itemRecieved($id)
{
  $sql = "DELETE FROM Items WHERE ID = $id";
  $sql = "DELETE FROM Matched WHERE ItemID = $id";
}
?>
