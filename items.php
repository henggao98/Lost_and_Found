<?php
// define variables and set to empty values
session_start();

$loggedIn = false;
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1)
{
  $userID = $_SESSION["id"];
  $loggedIn = true;
}

include_once 'db_connection.php';

$sql = "SELECT * FROM Items";
$result = $conn->query($sql);

$totalItems = mysqli_num_rows($result);
$itemsPerPage = 10;
$totalPages = ceil($totalItems / $itemsPerPage);

// Check that the page number is set.
if(!isset($_GET['page'])){
    $_GET['page'] = 0;
}else{
    // Convert the page number to an integer
    $_GET['page'] = (int)$_GET['page'];

}



// If the page number is less than 1, make it 1.
if($_GET['page'] < 1){
    $_GET['page'] = 1;
    // Check that the page is below the last page
}else if($_GET['page'] > $totalPages){
    $_GET['page'] = $totalPages;
}

$currentPage = (int)$_GET['page'];



$category = "";
$location = "";
$searched = "";


if(!empty($_SESSION["category"]))
  $category = $_SESSION["category"];
else
  $_SESSION["category"] = "";

if(!empty($_SESSION["search"]))
  $searched = $_SESSION["search"];
else
  $_SESSION["search"] = "";

if(!empty($_SESSION["location"]))
  $location = $_SESSION["location"];
else
  $_SESSION["location"] = "";


if ($_SERVER["REQUEST_METHOD"] == "POST")
{
  if(isset($_POST["search"])){

    $searched = test_input($_POST["search"]);
    $_SESSION["search"] = $searched;
    //echo "1";
  }

  elseif(isset($_POST["category"])){

    $category = $_POST["category"];
    $_SESSION["category"] = $category;
    //echo "2";
  }

  elseif(isset($_POST["location"])){

    $location = $_POST["location"];
    $_SESSION["location"] = $location;
    //echo "3";
  }

}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="items.css">
  <script>
    function autoSubmitCategory()
    {
        var categoryFormObject = document.forms['categoryForm'];
        categoryFormObject.submit();
    }
    function autoSubmitLocation()
    {
        var locationFormObject = document.forms['locationForm'];
        locationFormObject.submit();
    }
  </script>
</head>
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
  <form name="searchForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
    <input type="text" name="search" placeholder="Search.." value="<?php echo($_SESSION['search']); ?>">
    <input type="submit"
       style="position: absolute; left: -9999px; width: 1px; height: 1px;"
       tabindex="-1"  name="submitSearch" value="<?php echo $searched; ?>" />
  </form>
</div>

<div class="row">
  <div class="leftcolumn">

      <div class="card">
        <form name="categoryForm" id="categoryForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <h2>Category</h2>
          <label class="container">View All
            <input type="radio" name="category" <?php if ($category == "") { ?>checked='checked' <?php } ?>value="" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Phone
            <input type="radio" name="category" <?php if ($category == "Phone") { ?>checked='checked' <?php } ?>value="Phone" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Laptop
            <input type="radio" name="category" <?php if ($category == 'Laptop') { ?>checked='checked' <?php } ?>value="Laptop" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Wallet
            <input type="radio" name="category" <?php if ($category == "Wallet") { ?>checked='checked' <?php } ?>value="Wallet" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Keys
            <input type="radio" name="category" <?php if ($category == "Keys") { ?>checked='checked' <?php } ?>value="Keys" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Other
            <input type="radio" name="category" <?php if ($category == "Other") { ?>checked='checked' <?php } ?>value="Other" onChange="autoSubmitCategory();">
            <span class="checkmark"></span>
          </label>
        </form>
      </div>

      <div class="card">
        <form name="locationForm" id="locationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <h2>Location</h2>
          <label class="container">View All
            <input type="radio" name="location" <?php if ($location == "") { ?>checked='checked' <?php } ?>value="" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Bus
            <input type="radio" name="location" <?php if ($location == "Bus") { ?>checked='checked' <?php } ?>value="Bus" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Museum
            <input type="radio" name="location" <?php if ($location == "Museum") { ?>checked='checked' <?php } ?>value="Museum" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Street
            <input type="radio" name="location" <?php if ($location == "Street") { ?>checked='checked' <?php } ?>value="Street" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Restaurant
            <input type="radio" name="location" <?php if ($location == "Restaurant") { ?>checked='checked' <?php } ?>value="Restaurant" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
          <label class="container">Other
            <input type="radio" name="location" <?php if ($location == "Other") { ?>checked='checked' <?php } ?>value="Other" onChange="autoSubmitLocation();">
            <span class="checkmark"></span>
          </label>
        </form>
      </div>
  </div>
  <div class="rightcolumn">
    <?php include 'showItems.php';   ?>
  </div>
</div>

<div class="footer">
  <div class="center">
  <div class="pagination">

  <?php include 'pagination.php'; ?>

  </div>
</div>
</div>

</body>
</html>
