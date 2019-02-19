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

$sql = "SELECT Pass, Email FROM Users";
$result = $conn->query($sql);


$pass = $email = "";
$passErr = $emailErr = "";
$countOfSuccesfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  
  // EMAIL
  /*
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
  }
  else{*/
    $email = test_input($_POST["email"]);
    $countOfSuccesfulFields ++;
  //}

  // PASS
  /*if (empty($_POST["pass"])) {
    $passErr = "Last name is required";
  } else {*/
    $pass = test_input($_POST["pass"]);
    $countOfSuccesfulFields ++;
  //}
  
  
  
  if($countOfSuccesfulFields == 2)
  {
    $_SESSION["loggedIn"] = 0;
    while($row = $result->fetch_assoc()) 
      if($row["Email"] == $email && password_verify($pass, $row["Pass"]))
      {
          $_SESSION["loggedIn"] = 1;
          $_SESSION["id"] = $row["ID"];
          $_SESSION["email"] = $email;
          header('Location: index.html');
      }
    if($_SESSION["loggedIn"] == 0)
    {
      $_SESSION["loginError"] = "Wrong email or password";
      header('Location: login.html');
    }
        
                
        
  }//if
}//if

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
