<?php
include_once 'db_connection.php';

$sql = "SELECT ID, Pass, Email FROM Users";
$result = $conn->query($sql);


$pass = $email = "";
$passErr = $emailErr = "";
$countOfSuccesfulFields = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {/*copied from www.w3school.com */
  session_start();
  
  // EMAIL
  
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    $emailErr = "Invalid email format";
  }
  else{
    $email = test_input($_POST["email"]);
    $countOfSuccesfulFields ++;
  }

  // PASS
  if (empty($_POST["pass"])) {
    $passErr = "Last name is required";
  } else {
    $pass = test_input($_POST["pass"]);
    $countOfSuccesfulFields ++;
  }
  
  
  
  if($countOfSuccesfulFields == 2)
  {
    $_SESSION["loggedIn"] = 0;
    while($row = $result->fetch_assoc()) 
      if($row["Email"] == $email && password_verify($pass, $row["Pass"]))
      {
          $_SESSION["loggedIn"] = 1;
          $_SESSION["id"] = $row["ID"];
          echo $row["ID"];
          $_SESSION["email"] = $email;
          header('Location: index.php');
      }
    if($_SESSION["loggedIn"] == 0)
    {
      $_SESSION["loginError"] = "Wrong email or password";
      header('Location: index.php');
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
