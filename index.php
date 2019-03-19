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
	<a href="info.html"><button class="about">ABOUT</button></a>
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
<p>
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer tristique fringilla elit, eu pharetra justo scelerisque at. Pellentesque sed sapien ut ligula maximus vulputate. Fusce efficitur maximus lorem, et lobortis risus. Aliquam erat volutpat. Donec tempus placerat dui in consectetur. Nulla est risus, rutrum pharetra aliquam et, bibendum dictum purus. Praesent eget euismod arcu.
</p>

<p>
Sed dictum maximus dolor, quis semper magna facilisis et. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Etiam fermentum sem sed eros bibendum, eget consequat leo pretium. Integer leo libero, tincidunt nec lorem ac, tristique sollicitudin ante. Phasellus pretium hendrerit ligula, ut porta velit euismod et. Donec volutpat sodales justo, vel ultrices leo dignissim at. Mauris viverra odio scelerisque augue rutrum, ut eleifend arcu scelerisque. Cras pulvinar aliquet elementum.
</p>

<p>
Proin sollicitudin ex id nisi mattis pretium. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut interdum quam vitae ex consequat, sed consectetur arcu venenatis. Ut a dui luctus, elementum odio ut, iaculis ante. Curabitur bibendum quam velit, eu dignissim libero vulputate non. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Quisque pretium posuere turpis, id iaculis nulla sagittis ac. Donec at orci tellus. Duis lorem lacus, facilisis in ornare id, vulputate ac quam. Morbi vestibulum erat et egestas iaculis. Morbi finibus arcu eget imperdiet pretium. Quisque id hendrerit dui. Phasellus gravida libero id eros bibendum, at posuere elit tincidunt.
</p>

<p>
Nam sit amet orci lacinia, congue urna sit amet, tempus nisi. Nullam mollis nec velit id rhoncus. Pellentesque egestas aliquam lobortis. Suspendisse vitae nisl mauris. Mauris ac pharetra diam. Nunc lacinia risus nec viverra finibus. Nullam fermentum pulvinar urna a lobortis. Curabitur pharetra at nibh a efficitur. Cras placerat ut quam quis placerat. Maecenas posuere eu ex at tempor. Aenean molestie erat eros, semper sodales purus tristique ac.
</p>

<p>
Aenean lacinia molestie diam, nec iaculis purus lobortis non. Phasellus a nulla eu metus lobortis sollicitudin at vel justo. Quisque ut nunc eu erat elementum mollis at non odio. Aliquam lacinia quam at purus scelerisque, sit amet congue quam pulvinar. Suspendisse nec risus porta, sagittis lectus quis, commodo dolor. Vestibulum tincidunt nunc nisl, vel finibus nisi porta a. Praesent cursus tellus nisi, et mollis felis imperdiet ut. Duis mattis sollicitudin velit, vel consectetur diam mollis vel. Nam id erat diam. Integer suscipit ante nec massa dictum pharetra. Ut at tellus sed ante maximus pellentesque.
</p>
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
