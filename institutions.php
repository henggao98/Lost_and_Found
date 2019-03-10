<?php
// define variables and set to empty values
include_once 'db_connection.php';
session_start();
//$id = $_GET["id"];
$sql = "SELECT `ID`, `Name`, `Email`, `Rating`, `Phone` FROM `Users` WHERE `isInstitution` = 1";
$result = $conn->query($sql);

$totalItems = mysqli_num_rows($result);
$itemsPerPage = 3;
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

$location = "";
$searched = "";

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
<body>

<div class="topnav">
  <a href="index.php" style="float:right">Home</a>
  <a href="account.php" style="float:right">Account</a>
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
      <form name="locationForm" id="locationForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <h2>Location</h2>
        <label class="container">View All
          <input type="radio" name="location" <?php if ($location == "") { ?>checked='checked' <?php } ?>value="" onChange="autoSubmitLocation();">
          <span class="checkmark"></span>
        </label>
        <label class="container">Building
          <input type="radio" name="location" <?php if ($location == "Building") { ?>checked='checked' <?php } ?>value="Building" onChange="autoSubmitLocation();">
          <span class="checkmark"></span>
        </label>
        <label class="container">Museum
          <input type="radio" name="location" <?php if ($location == "Museum") { ?>checked='checked' <?php } ?>value="Museum" onChange="autoSubmitLocation();">
          <span class="checkmark"></span>
        </label>
        <label class="container">Cafe
          <input type="radio" name="location" <?php if ($location == "Cafe") { ?>checked='checked' <?php } ?>value="Cafe" onChange="autoSubmitLocation();">
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
    <?php include 'showInstitutions.php';   ?>
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
