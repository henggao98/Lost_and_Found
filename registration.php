

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


$isTaken = false;
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
    
    while($row = $email_check->fetch_assoc())
    {
      if($row["Email"] == $email)
        $isTaken = true;
    }

    if($isTaken)
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
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO Users (Name, Email, Pass)
                VALUES ('{$name}', '{$email}', '{$hashPass}')";

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
