<?php
include_once 'db_connection.php';

$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);

$isTakenG = false;
$name = $email = "";
$nameErrG = $emailErrG = "";
$countOfSuccesfulFieldsG = 0;

$isTakenF = false;
$name = $pass = $email = "";
$nameErrF = $emailErrF = $passErrF = "";
$countOfSuccesfulFieldsF = 0;

session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  if(!empty($_POST["Full"]))
  {
    include 'registration_functionality.php';

  }
  elseif(!empty($_POST["Guest"]))
  {
    include 'registrationGuest.php';
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
  <link rel="stylesheet" href="registration.css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
<body>

<img src="homePageLogo.png" class="logo">

<div class="topnav">
    <a href="index.php" style="color:white"><i class="fa fa-fw fa-home">
    </i>Home</a>
	
    <a href="registration.php" class="active" style="color:white"><i class="fa fa-key"></i>Registration</a>

    <a href="registerInstitution.php" style="color:white"><i class="fa fa-key"></i>Register an institution</a>
	
	<a href="account.php" style="color:white"><i class="fa fa-fw fa-user"></i>Account</a>
	
    <a href="institutions.php" style="color:white"><i class="fa fa-fw fa-globe"></i>Search Places</a>
	
    <a href="items.php" style="color:white"><i class="fa fa-fw fa-search"></i>Search Items</a>
	
    <a href="found.php" style="color:white"><i class="fas fa-hand-holding-heart"></i>Found Something</a>
</div>

<div class="gridContainer">

  <div class="gridItem">
    <h1><legend align="center"><b>Register as a guest</b></legend></h1>
  <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <?php
      if(empty($nameErrG)) 
      { 
        ?>
        <span class="error">*</span>
        <label>Name</label>
        <?php 
      }
      else
      {
        ?>
        <span class="error">* <?php echo $nameErrG;?> </span>
        <?php
      } 
      ?>
      <input type="text" name="name" placeholder="Your name.." required>

      <?php
      if(empty($emailErrG)) 
      { 
        ?>
        <span class="error">*</span>
        <label>Email</label>
        <?php 
      }
      else
      {
        ?>
        <span class="error">* <?php echo $emailErrG;?> </span>
        <?php
      } 
      ?>
      <input type="text" name="email" placeholder="Your email.." required>
    
    <label class="termsAndCond">I have read and agree to the
      <a href="terms.html"> Terms and conditions</a> and the
    <a href="privacy.html"> Privacy Policy.</a>
      <input type="checkbox" required>
      <span class="checkmark"></span>
      </label>
  
      <input class="buttons" type="submit" value="Register" name="Guest">
    </form>
  </div>
  
  <div class="gridItem">
    <h1><legend align="center"><b>Register</b></legend></h1>
  <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

      <?php
      if(empty($nameErrF)) 
      { 
        ?>
        <span class="error">*</span>
        <label>Name</label>
        <?php 
      }
      else
      {
        ?>
        <span class="error">* <?php echo $nameErrF;?> </span>
        <?php
      } 
      ?>
      <input type="text" name="name" placeholder="Your name.." required>

      <?php
      if(empty($emailErrF)) 
      { 
        ?>
        <span class="error">*</span>
        <label>Email</label>
        <?php 
      }
      else
      {
        ?>
        <span class="error">* <?php echo $emailErrF;?> </span>
        <?php
      } 
      ?>
      <input type="text" name="email" placeholder="Your email.." required>

      <?php
      if(empty($passErrF)) 
      { 
        ?>
        <span class="error">*</span>
        <label>Password</label>
        <?php 
      }
      else
      {
        ?>
        <span class="error">* <?php echo $passErrF;?> </span>
        <?php
      } 
      ?>
      <input type="password" name="pass" placeholder="Your password.." required>

      <span class="error">*</span>
      <label>Repeat Password</label>
      <input type="password" name="pass2" placeholder="Confirm password.." required>
    
    <label class="termsAndCond">I have read and agree to the
      <a href="terms.html"> Terms and conditions</a> and the
    <a href="privacy.html"> Privacy Policy.</a>
      <input type="checkbox" required>
      <span class="checkmark"></span>
      </label>
  
      <input class="buttons" type="submit" value="Register" name="Full">
    </form>
  </div>
</div>

</body>
</html>
