<?php
// define variables and set to empty values
include_once 'db_connection.php';

$sql = "SELECT ItemName, Descript, Location, Date FROM Items";
$result = $conn->query($sql);
$category = "";
$location = "";

if(isset($_GET["category"]))
{
  $category = $_GET['category'];
}

if(isset($_GET["location"]))
{
  $location = $_GET["location"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    echo "Probe";
}

?>



<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="items.css">
  <script>
    function autoSubmitCategory()
    {
        var categoryFormObject = document.forms['categotyForm'];
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
  <a href="#" style="float:right">Home</a>
  <a href="#" style="float:right">Account</a>
  <form name="search" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <input type="text" name="search" placeholder="Search..">
    <input type="submitSearch" 
       style="position: absolute; left: -9999px; width: 1px; height: 1px;"
       tabindex="-1" />
  </form>
</div>

<div class="row">
  <div class="leftcolumn">

      <div class="card">
        <form name="categotyForm" id="categotyForm">
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
        <form name="locationForm" id="locationForm">
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
            <input type="radio" name="location" <?php if ($location == "Stree") { ?>checked='checked' <?php } ?>value="Street" onChange="autoSubmitLocation();">
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
  <a href="#">&laquo;</a>
  <a href="#" class="active">1</a>
  <a href="#">2</a>
  <a href="#">3</a>
  <a href="#">4</a>
  <a href="#">5</a>
  <a href="#">6</a>
  <a href="#">&raquo;</a>
  </div>
</div>
</div>

</body>
</html>

