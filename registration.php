

<?php
// define variables and set to empty values

$servername = "dbhost.cs.man.ac.uk";
$username = "j78532kt";
$password = "kaloyandb";
$dbname = "2018_comp10120_z8";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);



$name = $lname = $email = "";
$nameErr = $emailErr = $passErr = "";
$countOfSuccesfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  
  // Name
  if (empty($_POST["name"])) {
    $nameErr = "First name is required";
  } else {
    $name = test_input($_POST["name"]);
    $_SESSION["name"] = $name;
    $countOfSuccesfulFields ++;
  }


  // PASS
  if (empty($_POST["pass"])) {
    $passErr = "Empty field";
  } else{
    $countOfSuccesfulFields ++;
  }



  // PASS2
  if (empty($_POST["pass2"])) {
    $passErr = "Empty field";
  }
  else if($_POST["pass2"] != $_POST["pass"])
  {
    $passErr = "Do not match";
  } 
  else {
    $pass = test_input($_POST["pass"]);
    $countOfSuccesfulFields ++;
  }

  
  
  


  // EMAIL
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {/*copied from www.w3school.com */
    $emailErr = "Invalid email format";
  }
  else{
    $email = test_input($_POST["email"]);
    $isTaken = false;
    while($row = $email_check->fetch_assoc()) 
      if($row["Email"] == $email)
        $isTaken = true;
    if(isTaken)
    {
      $emailErr = "Email has already been taken";
    }
    else
    {
      $_SESSION["email"] = $email;
      $countOfSuccesfulFields ++;
    }
  }
  
  if($countOfSuccesfulFields == 4)
  {
        
    $insertQuery = "INSERT INTO Users (Name, Email, Pass)
                VALUES ('{$name}', '{$email}', '{$pass}')";

    if($conn->query($insertQuery) === TRUE)
      echo "New record created successfully";
      //header('Location: greeting.php');
    else
      echo "Error";

        
  }//if
}//if

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>


<!DOCTYPE html>
<html>
<body>

Registration form.
<form method="post" action="/lost/Lost_and_Found/registration.php">
  <fieldset>
    <legend>Personal information:</legend>
    First name:<br>
    <input type="text" name="name" value="<?php echo $name;?>" required>
    <span class="error">* <?php echo $nameErr;?> </span>
    <br>
    Email:<br>
    <input type="email" name="email" value="<?php echo $email;?>" required>
    <span class="error">* <?php echo $emailErr;?> </span>
    <br>
    Password:<br>
    <input type="password" name="pass" required>
    <span class="error">* <?php echo $passErr;?> </span>
    <br>
    Repeat Password:<br>
    <input type="password" name="pass2" required>
    <span class="error">* <?php echo $pass2Err;?> ></span>
    <br>
    <br>
    <input type="submit" value="Submit">
  </fieldset>
</form>

</body>
</html>