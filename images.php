<?php
session_start();
include("db_connection.php");

$sql = "SELECT Email FROM Users";
$email_check = $conn->query($sql);

$isTaken = false;
$name = $pass = $email = $phone = "";
$nameErr = $emailErr = $passErr = $phoneErr = "";
$countOfSuccesfulFields = 0;

if(isset($_POST['Register'])){
  // Name
  if (empty($_POST["name"])) {
    $nameErr = "First name is required";
  } else {
    $name = test_input($_POST["name"]);
  //  $_SESSION["name"] = $name;
    $countOfSuccesfulFields ++;
    echo "name successful";
  }

  // PASS
  if (empty($_POST["pass"])) {
    $passErr = "Empty field";
  } else{
    $countOfSuccesfulFields ++;
    echo "pass successful";
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
        echo "pass2 successful";
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
  //    $_SESSION["email"] = $email;
      $countOfSuccesfulFields ++;
          echo "email successful";
    }
  }

  // Phone
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone Number is required";
  } else {
    $phone = test_input($_POST["phone"]);
  //  $_SESSION["phone"] = $phone;
    $countOfSuccesfulFields ++;
        echo "phone successful";
  }

  if($countOfSuccesfulFields == 5)
  {
    echo "Successful fields = 5";
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO Users (Name, Email, Pass, Phone)
                VALUES ('{$name}', '{$email}', '{$hashPass}','{$phone}')";

    if($conn->query($insertQuery) === TRUE) {
      $imgName = $_FILES['file']['name'];
      $target_dir = "upload/";
      $target_file = $target_dir . basename($_FILES["file"]["name"]);

      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");
      $institutionSQL = "SELECT ID FROM Users WHERE Email ='$email' ";
      $institutionResult = $conn->query($institutionSQL);
      $institiutionDetail = $institutionResult->fetch_assoc();
      $instID = $institiutionDetail["ID"];
      // Check extension
      if( in_array($imageFileType,$extensions_arr) ){

         // Insert record
         $query = "INSERT INTO Images (InstID, Name)
                   VALUES('{$instID}','{$imgName}')";
         if(mysqli_query($conn,$query) === TRUE)
          echo "successfully uploaded path image to DB";
         else
          echo "Error with uploading path image to DB";

         // Upload file
         move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
      //header('Location: greeting.php');
      }
      else echo "Error1";
    }
      else
        echo "Error2";
  }

}
else echo "Error 3";

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>
