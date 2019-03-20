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
include 'login.php';
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
  </div>
  <?php
}
else
{
  ?>
  <div id="topnavbar">
    <button class="login" onclick="popup()">LOGIN</button>
      <a href="registration.php">
        <button class="register">REGISTER</button></a>
	    <a href="info.html"><button class="info">ABOUT</button></a>
    </div>
  <?php
}
?>

<div class="formPopup" id="myForm">
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="formContainer" method="POST">
    <center><h2>Login</h2></center>

	  <span class="error"> <?php echo $emailErr;?> </span>
    <label for="email"><b>Email</b></label>
    <input type="email" placeholder="Enter Email" name="email" required>

	  <span class="error"> <?php echo $emailErr;?> </span>
    <label for="pass"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="pass" required>
    
    <span class="error"> <?php echo $Error;?> </span>

    <a href="fb-login.php"><button class="facebook">Log in with Facebook!</button></a>
	
	<button type="submit" class="popupLogin">Login</button>
  </form>
</div>

<img src="homePageLogo.png" class="logo">

<center>

<div class="buttonContainer">
  <div>
    <button onclick="location.href='./items.php';" class="buttons lostButton">LOST SOMETHING</button>
	<button onclick="location.href='./found.html';" class="buttons foundButton">FOUND SOMETHING</button>
  </div>
  <div>
	<button onclick="location.href='./institutions.php';" class="locationButton">SEARCH FOR A LOCATION</button>
  </div>
</div>

<center>

<div class="infoContainer">
</div>

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
