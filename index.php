<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="homePage2.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <title>Lost and Found Home Page</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


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
    <a href="info.html"><button class="info">ABOUT</button></a>
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
	<button onclick="location.href='./institutions.php';" class="locationButton">SEARCH FOR A LOCATION</button>
  </div>
</div>

<center>

<div class="infoContainer" id="info">
  <div class="row">
    <div class="column0" >
		<div class="card">
			<h2>How to look for a lost item?</h2>	
			<div class="clearfix"> <i class="fa fa-search" style=" font-size:120px; float:right; padding:10px"></i> Are you looking for an item you misplaced in Manchester? Welcome to <b>Lost&Found</b> where you don't even have to create 
			an account to look for your belongings! If an item you are looking for has been posted, it is available to view on this <a href="items.html"  class="links">page</a>. 
			In order to look for an object you might use the search engine provided or choose from the options enlisted on the side.
		</div>
	</div>
	
		<br>
		<div class="card">
			<h2>How to exchange the item?</h2>
			<div class="clearfix">
			<i class="fas fa-coffee" style="font-size:100px; float:right; padding:10px"></i>
			In order to exchange the item the owner of the item must claim it from the user that uploaded the given item to the <b>Lost&Found</b> website. After claiming the item both the claimer and the finder must exchange information about the item making both of the sure its their property, for example exchange information about specific damage of the item or any other specifics coming to mind, may vary with different items. <b> UNDER NO CIRCUMSTANCES SHOULD YOU EXCHANGE PASSWORDS OR PIN CODES! </b> If the finder wants to make sure the claimer is the owner of valuable property like laptop or smartphone, he or she can ask them during the meeting to unlock the device, but as a claimer/owner NEVER PROVIDE THEM WITH THE PASSWORD BEFOREHAND.
            <br><br>
            In terms of meetings we highly advise everyone to meet in public spaces such as cafes, libraries, etc. We do so in order to prevent any unpleasant meeting between our users. In case you have a bad experience with a user <b>(i.e. phishing, unpleasant exchange of information or anything else you find unusual)</b> each of the registered users has a comment section, where you can leave a note about your experience or contact us via lost.and.found.um@gmail.com.
			</div>
		</div>
	</div>
	
	<div class="column1" >
		<div class="card">
			<h2>How to upload a found item?</h2>
			<p>If you happened to have found an item that does not belong to you and would like to find the owner you found the 
			perfect website for the job! Our website enables you to upload an item in the most convenient ways, you don't even have to 
			create an account, provide us just with your email and we will take care of the rest!</p>
			<p>Registering with our website in order to exchange the found item comprises of just 3 simple steps:</p>
				<h3>Register</h3>
					<div class="clearfix">
					<i class="far fa-address-card" style="font-size:100px; float:left; padding:10px"></i> 
					As a <b>finder</b> you need to provide us with some details. Our <a href="registration.html" class="links">registration</a> process is simple and takes no more than 2 minutes.
					However, if you don't feel like creating the account on yet another website ours offers a <a href="registration.html" class="links">guest registration</a>, where you provide us only with
					your first name and an email enabling the owner of the found property to contact with you.
					<br>
					</div>
				<h3>Complete the item form</h3>
					<div class="clearfix">
					<i class="fa fa-upload" style="font-size:120px; float:left; padding:0 10px 0 10px"></i>
					<br>
					In order for the item to appear on our website you need to fill out our <b>found item form</b>.You will need to provide us with details about location, where the item was found, type of the object, as well as a short description of it. The <b>important note</b> about the description you provide is that it contains:
					<ul>
                    <li>Date you found the item</li>
                    <li>Description of the place you found it at (i.e. if chosen “public transport” add “found on bus 147”)</li>
                    <li>Vague description of it (i.e. if the item you found has a specific feature like a specific colour of the etui, or specific scratch or damage <b>DO NOT</b> contain that information in the description.)</li>
					</ul>
                    We ask you to write a very vague description allowing you to ask the claimer a more detailed question. We do so in order to make sure the item is returned to its true owner, which can only be achieved if the owner knows the specifics of the item you found.
					</div>
				<h3>Meet</h3>
					<div class="clearfix">
					<i class="fa fa-handshake-o" style="font-size:87px; float:left; padding:10px"></i>
					Provided that you exchanged information with the claimer and decide that the details they gave you show its their property you must arrange a meeting in order to give the claimed item back to its owner.
					</div>
		</div>
	</div>
  </div>
  <div class="footer" style="color:#FFBB33"><center><a href="privacy.html" class="links"> Privacy Policy </a> --- <a href="terms.html" class="links"> Terms of use</a></center></div>
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
