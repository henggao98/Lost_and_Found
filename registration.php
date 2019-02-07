<?php
// define variables and set to empty values

$servername = "dbhost.cs.man.ac.uk";
$username = "j78532kt";
$password = "kaloyandb";
$dbname = "j78532kt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT fname, lname, email FROM people";
$result = $conn->query($sql);

$sql2 = "SELECT fname, lname, email FROM team";
$teamResult = $conn -> query($sql2);



$fname = $lname = $email = "";
$fnameErr = $lnameErr = $emailErr = "";
$countOfSuccesfulFields = 0;
if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  if (empty($_POST["fname"])) {
    $fnameErr = "First name is required";
  } else {
    $fname = test_input($_POST["fname"]);
    $_SESSION["fname"] = $fname;
    $countOfSuccesfulFields ++;
  }
  
  if (empty($_POST["lname"])) {
    $lnameErr = "Last name is required";
  } else {
    $lname = test_input($_POST["lname"]);
    $_SESSION["lname"] = $lname;
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
        $_SESSION["fromPeople"] = 0;
        while($row = $result->fetch_assoc()) 
            if($row["fname"] == $fname && $row["lname"] = $lname && $row["email"] == $email)
                $_SESSION["fromPeople"] = 1;
        
        
        
        $_SESSION["fromTeam"] = 0;            
        while($row = $teamResult->fetch_assoc()) 
            if($row["fname"] == $fname && $row["lname"] = $lname && $row["email"] == $email)
                $_SESSION["fromTeam"] = 1;   
                
        if($_SESSION["fromPeople"] == 0 && $_SESSION["fromTeam"] == 0)
        {
            $insertQuery = "INSERT INTO people (fname, lname, email)
                VALUES ('{$fname}', '{$lname}', '{$email}')";
            if($conn->query($insertQuery) === TRUE)
                $_SESSION["insertStatus"] = 1;
            else
                $_SESSION["insertStatus"] = 0; 
         }           
                
        header('Location: greeting.php');
  }//if
}//if

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>
