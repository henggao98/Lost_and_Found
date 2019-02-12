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

$sql = "SELECT Name, Pass, Email FROM Users";
$result = $conn->query($sql);


$name = $pass = $email = "";
$nameErr = $passErr = $emailErr = "";
$countOfSuccesfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  if (empty($_POST["name"])) {
    $nameErr = "First name is required";
  } else {
    $name = test_input($_POST["name"]);
    $_SESSION["name"] = $name;
    $countOfSuccesfulFields ++;
  }
  
  if (empty($_POST["pass"])) {
    $passErr = "Last name is required";
  } else {
    $pass = test_input($_POST["pass"]);
    $_SESSION["pass"] = $pass;
    $countOfSuccesfulFields ++;
  }
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {/*copied from www.w3school.com */
    $emailErr = "Invalid email format";
  }
  else{
    $email = test_input($_POST["email"]);
    $_SESSION["email"] = $email;
    $countOfSuccesfulFields ++;
  }
  
  if($countOfSuccesfulFields == 3)
  {
        $_SESSION["loggedIn"] = 0;
        while($row = $result->fetch_assoc()) 
            if($row["name"] == $name && $row["pass"] = $pass && $row["email"] == $email)
            {
                $_SESSION["loggedIn"] = 1;
                header('Location: index.html');
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
