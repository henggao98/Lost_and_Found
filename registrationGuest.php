<?php
include_once 'db_connection.php';

$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);


$isTaken = false;
$name = $email = "";
$nameErr = $emailErr = "";
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
  
  if($countOfSuccesfulFields == 2)
  {
    $pass = randomPassword();
    print $pass;
    $msg = "Just in case you ever lost something here is your password: \n"
      + $pass;
    mail($email, "Your password for Lost & Found", $msg);
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

function randomPassword() {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass); //turn the array into a string
}

?>
