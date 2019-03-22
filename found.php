<?php
include "found_functionality.php";

 ?>

<!DOCTYPE HTML>
<html>
<head>
<link rel="stylesheet" type="text/css" href="found.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>


 <!--<div class = "box">-->
 <div class="header0">
    <b>Lost & Found</b>
</div>
   <ul class="a">
    <li><a href="index.php"><i class="fa fa-fw fa-home"></i>Home</a></li>
    <li><a href="account.php"><i class="fa fa-fw fa-user"></i>Account</a></li>
    <li><a href="info.html"><i class="fa fa-fw fa-info-circle"></i>About</a></li>
    <li><a href="institutions.php"><i class="fa fa-fw fa-globe"></i>Search Places</a></li>
    <li><a href="items.php"><i class="fa fa-fw fa-search"></i>Search Items</a></li>
    <li><a href="found.php" class="active"><i class='fas fa-hand-holding-heart'></i>Found Something</a></li>
  </ul>
  <br>
<div class="row">
  <div class="column side"><center><br><br>
  <img src="train(1).png" width="65%"><br>
  <img src="place.png" width="65%" alt="Flowers in Chania"><br><br><br>
  <img src="museum.png" width="65%"><br></center><br>
  </div>
  <div class="column middle" >
  <div class="container">
  <div class="title"
  <h2><b>What have you found?   </b></h2><div class="dropdown">
          <i class='fas fa-exclamation-circle' style='font-size:25px; color: #FF7F00'></i>
          <div class="dropdown-content">
		  In order to obtain more detailed information about how to properly fill out this form please visit our <a href = "info.html">info page </a>.
  </div></div>
  </div>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  <div class="row">
    <div class="col-25">
      <label for="location">Location</label>
    </div>
    <div class="col-75">
	<script type="text/javascript">
		function showfield(location){
		  if(location=='other')document.getElementById('div1').innerHTML=' <br> Provide the location in the field below: <input type="text" name="locationOther" required/>';
		  else document.getElementById('div1').innerHTML='';
		}
		</script>
    		<select id="country" name="location" onchange="showfield(this.options[this.selectedIndex].value)" required>
		<option selected disabled>Choose type of location...</option>
        <option value="transport">Public Transport</option>
        <option value="university">University</option>
        <option value="museum">Museum</option>
		<option value="library">Libary</option>
        <option value="other">Other</option>
      </select>
	  <div id="div1"></div>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="type">Type of the object: </label>
    </div>
    <div class="col-75">
		<script type="text/javascript">
		function showfield0(name){
		  if(name=='other')document.getElementById('div2').innerHTML=' <br> Provide the type of the item in the field below: <input type="text" name="nameOther" required />';
		  else document.getElementById('div2').innerHTML='';
		}
		</script>
       <select id="type" name="itemName" onchange="showfield0(this.options[this.selectedIndex].value)" required>
	   <option selected disabled>Choose type of object...</option>

         	<option value="wallet">Wallet</option>
         	<option value="keys">Keys</option>
         	<option value="laptop">Laptop</option>
		 	<option value="phone">Phone</option>
         	<option value="other">Other</option>

       </select>
	   <div id="div2"></div>
	</div>
	</div>

	<div class="row">
      <div class="col-25">
        <label for="item_description">Brief description of the item <tab>
		<div class="dropdown">
          <i class='fas fa-exclamation-circle' style='font-size:18px; color: #FF7F00'></i>
          <div class="dropdown-content">
          In order to avoid any possibility of illegal collection of items please provide a vague description allowing you as the collector to verify whether an item belongs to the claimer if they reach out to you.
  </div></label>
</div>

      </div>
      <div class="col-75">
        <textarea id="item_description" name="description" placeholder="Please contain date of finding, location and vague description. For more info check exclamation marks!" style="height:190px" required></textarea>
      </div>
    </div>
	<br>
    <div class="row">
 <input type="submit" value="Submit">
    </div>

	</div>
    </form>
</div>

  <div class="column side" ><center><br><br>
  <img src="passport.png" width="65%"><br><br>
  <img src="wallet.png" width="65%"><br><br>
  <img src="smartphone.png" width="65%"><br></center>
  </div>
  </div>
  </div>
  <div class="footer"><center><a href="privacy.html"> Privacy Policy </a> --- <a href="terms.html"> Terms of use</a></center></div>
</body>
</html>
