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

$sql = "SELECT email FROM users";
$email_check = $conn->query($sql);

$sql2 = "SELECT name, email FROM team";
$teamResult = $conn -> query($sql2);



$name = $lname = $email = "";
$nameErr = $lnameErr = $emailErr = "";
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
    $passErr = "Empty field";
  }
  else if($_POST["pass"] != $_POST["pass2"])
  {
    $passErr = "Do not match";
  } 
  else {
    $name = test_input($_POST["name"]);
    $_SESSION["name"] = $name;
    $countOfSuccesfulFields ++;
  }

  $isTaken = false;
  while($row = $email_check->fetch_assoc()) 
    if($row["email"] == $email)
      $isTaken = true;
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {/*copied from www.w3school.com */
    $emailErr = "Invalid email format";
  }
  else if(isTaken)
  {
    $emailErr = "Email has already been taken";
  }
  else{
    $email = test_input($_POST["email"]);
    $_SESSION["email"] = $email;
    $countOfSuccesfulFields ++;
  }
  
  if($countOfSuccesfulFields == 3)
  {
        
    $insertQuery = "INSERT INTO users (Name, Email, Pass)
                VALUES ('{$name}', '{$email}', '{$pass}')";

    if($conn->query($insertQuery) === TRUE)
      header('Location: greeting.php');
    else
      ?> <html>something went wrong </html>><?php 

    /*
        $_SESSION["fromPeople"] = 0;
        while($row = $result->fetch_assoc()) 
            if($row["name"] == $name && $row["lname"] = $lname && $row["email"] == $email)
                $_SESSION["fromPeople"] = 1;
        
        
        
        $_SESSION["fromTeam"] = 0;            
        while($row = $teamResult->fetch_assoc()) 
            if($row["name"] == $name && $row["lname"] = $lname && $row["email"] == $email)
                $_SESSION["fromTeam"] = 1;   
                
        if($_SESSION["fromPeople"] == 0 && $_SESSION["fromTeam"] == 0)
        {
            
            if($conn->query($insertQuery) === TRUE)
                $_SESSION["insertStatus"] = 1;
            else
                $_SESSION["insertStatus"] = 0; 
         }           
      */
        
  }//if
}//if

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
