

<?php
//include_once 'db_connection.php';
/*
$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);


$isTakenF = false;
$name = $pass = $email = "";
$nameErrF = $emailErrF = $passErrF = "";
$countOfSuccesfulFieldsF = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
*/  
  // Name
  if (empty($_POST["name"])) {
    $nameErrF = "First name is required";
  } else {
    $name = test_input($_POST["name"]);
    //$_SESSION["inputNameF"] = $name;
    $countOfSuccesfulFieldsF ++;
  }


  // PASS
  if (empty($_POST["pass"])) {
    $passErrF = "Empty field";
  } else{
    $countOfSuccesfulFieldsF ++;
  }



  // PASS2
  if (empty($_POST["pass2"])) {
    $passErrF = "Empty field";
  }
  else if($_POST["pass2"] != $_POST["pass"])
  {
    $passErrF = "Do not match";
  } 
  else {
    $pass = test_input($_POST["pass"]);
    $countOfSuccesfulFieldsF ++;
  }

  
  
  


  // EMAIL
  if (empty($_POST["email"])) {
    $emailErrF = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {/*copied from www.w3school.com */
    $emailErrF = "Invalid email format";
  }
  else{
    $email = test_input($_POST["email"]);
    
    while($row = $email_check->fetch_assoc())
    {
      if($row["Email"] == $email)
        $isTakenF = true;
    }

    if($isTakenF)
    {
      $emailErrF = "Email has already been taken";
    }
    else
    {
      //$_SESSION["email"] = $email;
      $countOfSuccesfulFieldsF ++;
    }
  }
  
  if($countOfSuccesfulFieldsF == 4)
  {
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO Users (Name, Email, Pass)
                VALUES ('{$name}', '{$email}', '{$hashPass}')";

    $_SESSION['loggedIn'] = 0;
    if($conn->query($insertQuery) === TRUE)
    {
      //echo "New record created successfully";
      $_SESSION['id'] = $conn->insert_id;
      $_SESSION['loggedIn'] = 1;
      $_SESSION['name'] = $name;
      $_SESSION['email'] = $email;
      header('Location: index.php');
    }
    else
      echo "Error";

        
  }//if
/*  
}//if

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
*/
?>
