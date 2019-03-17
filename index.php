<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="homePage2.css">
  <title>Lost and Found Home Page</title>
</head>


<body background="homePageBackground.jpg" class="background">

<?php 
include_once 'db_connection.php';
session_start();
if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 1)
{
  $id = $_SESSION["id"];
  $sql = "SELECT Name FROM Users WHERE ID = '$id'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $name = $row["Name"];
  ?>
  <div id="topnavbar">
    <a href="logout.php">
      <button class="login">
        Logout
      </button>
    </a>
    <a href="account.php">
      <button class="login">
        <?php echo $name; ?>
      </button>
    </a>
	<a href="info.html"><button class="about">ABOUT</button></a>
    <div class="popoverWrapper">
    <button class="popoverTitle info">INFO</button>
      <div class="popoverContent">
        <p class="popoverMessage">
	  To search for an item, you need to login first.
	  After logging in, you can search for an item by clicking on the LOST SOMETHING button. Or you can post an item that you found by clicking on the FOUND SOMETHING button.
	    </p>
      </div>
    </div>
  </div>
  <?php
}
else
{
  ?>
  <div id="loginAndRegistrationButton">
    <button class="login" onclick="popup()">LOGIN</button>
    <a href="registration.html">
      <button class="login">REGISTER</button>
    </a>
	<a href="info.html"><button class="about">ABOUT</button></a>
    <div class="popoverWrapper">
      <button class="popoverTitle info">INFO</button>
      <div class="popoverContent">
        <p class="popoverMessage">
	  To search for an item, you need to login first.
	  After logging in, you can search for an item by clicking on the LOST SOMETHING button. Or you can post an item that you found by clicking on the FOUND SOMETHING button.
	    </p>
      </div>
    </div>
  </div>
  <?php
}
?>

<div class="formPopup" id="myForm">
  <form action="login.php" class="formContainer" method="POST">
    <center><h2>Login</h2></center>

	  <!--<span class="error"> <?php echo $_SESSION["nameErr"];?> </span>-->
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

	  <!--<span class="error"> <?php echo $_SESSION["emailErr"];?> </span>-->
    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>

    <button type="submit" class="popupLogin">Login</button>
  </form>
  <a href="fb-login.php"><button class="facebook">Log in with Facebook!</button></a>
</div>

<img src="homePageLogo.png" class="logo">

<center>

<div class="buttonContainer">
  <div>
    <button onclick="location.href='./items.php';" class="buttons lostButton">LOST SOMETHING</button>
	<button onclick="location.href='./found.php';" class="buttons foundButton">FOUND SOMETHING</button>
  </div>
  <div>
	<button onclick="location.href='./institutions.php';" class="locationButton">PUBLIC PLACES</button>
  </div>
</div>

<center>

<script>
/* When the user clicks on the login button,
toggle between hiding and showing the login form */
function popup()
{
  document.getElementById("myForm").classList.toggle("show");
}
</script>

</body>
</html>
