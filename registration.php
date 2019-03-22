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
<body>

<img src="homePageLogo.png" class="logo">

<div class="navbar">
  <ul>
    <li>
    <a class="navButton" href="index.html"><i class="fa fa-fw fa-home">
    </i>Home</a>
    </li>
  
    <li>
    <a class="navButton" href="registerInstitution.html"><i class="fa fa-key"></i>Register an institution</a>
    </li>
	
  </ul>
</div>


<div class="gridContainer">

  <div class="gridItem">
    <h1><legend align="center"><b>Register as a guest</b></legend></h1>
  <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <span class="error">* <?php echo $nameErrG;?> </span>
      <input type="text" name="name" placeholder="Your name.." required>

      <span class="error">* <?php echo $emailErrG;?> </span>
      <input type="text" name="email" placeholder="Your email.." required>
    
    <label class="termsAndCond">I have read and agree to the
      <a href="#"> Terms and conditions</a> and the
    <a href="#"> Privacy Policy.</a>
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
      <span class="error">* <?php echo $nameErrF;?> </span>
      <input type="text" name="name" placeholder="Your name.." required>

      <span class="error">* <?php echo $emailErrF;?> </span>
      <input type="text" name="email" placeholder="Your email.." required>

      <span class="error">* <?php echo $passErrF;?> </span>
      <input type="password" name="pass" placeholder="Your password.." required>

      <span class="error">*</span>
      <input type="password" name="pass2" placeholder="Confirm password.." required>
    
    <label class="termsAndCond">I have read and agree to the
      <a href="#"> Terms and conditions</a> and the
    <a href="#"> Privacy Policy.</a>
      <input type="checkbox" required>
      <span class="checkmark"></span>
      </label>
  
      <input class="buttons" type="submit" value="Register" name="Full">
    </form>
  </div>
</div>

</body>
</html>