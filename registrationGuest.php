<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";
//include_once 'db_connection.php';
/*
$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);


$isTakenG = false;
$name = $email = "";
$nameErrG = $emailErrG = "";
$countOfSuccesfulFieldsG = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  session_start();
*/  
  // Name
  if (empty($_POST["name"])) {
    $nameErrG = "First name is required";
  } else {
    $name = test_input($_POST["name"]);
    //$_SESSION["inputNameG"] = $name;
    $countOfSuccesfulFieldsG ++;
  }

  // EMAIL
  if (empty($_POST["email"])) {
    $emailErrG = "Email is required";
  } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {/*copied from www.w3school.com */
    $emailErrG = "Invalid email format";
  }
  else{
    $email = test_input($_POST["email"]);
    
    while($row = $email_check->fetch_assoc())
    {
      if($row["Email"] == $email)
        $isTakenG = true;
    }

    if($isTakenG)
    {
      $emailErrG = "Email has already been taken";
    }
    else
    {
      //$_SESSION["inputEmailG"] = $email;
      $countOfSuccesfulFieldsG ++;
    }
  }
  
  if($countOfSuccesfulFieldsG == 2)
  {
    $pass = randomPassword();
    print $pass;
    $msg = "Just in case you ever lost something here is your password: \n"
      . $pass;

    $mail = new PHPMailer(TRUE);

    try {
       
       $mail->setFrom('lost.and.found.uom@gmail.com', 'Lost & Found');
       $mail->addAddress($email, "Dear " . $name);
       $mail->Subject = 'Your password for Lost & Found';
       $mail->Body = $msg;
       $mail->isSMTP();
       $mail->Host = 'smtp.gmail.com';
       $mail->SMTPAuth = TRUE;
       $mail->SMTPSecure = 'tls';
       $mail->Username = 'lost.and.found.uom@gmail.com';
       $mail->Password = 'lost&found';
       $mail->Port = 587;

       /* Disable some SSL checks. */
       $mail->SMTPOptions = array(
          'ssl' => array(
          'verify_peer' => false,
          'verify_peer_name' => false,
          'allow_self_signed' => true
          )
       );
       
       /* Enable SMTP debug output. */
       //$mail->SMTPDebug = 4;
       
       $mail->send();
    }
    catch (Exception $e)
    {
       echo $e->errorMessage();
    }
    catch (\Exception $e)
    {
       echo $e->getMessage();
    }

    //mail($email, "Your password for Lost & Found", $msg);
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO Users (Name, Email, Pass)
                VALUES ('{$name}', '{$email}', '{$hashPass}')";

    //session_start();
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
