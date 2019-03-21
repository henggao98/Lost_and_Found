<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

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
  //    $_SESSION["email"] = $email;
      $countOfSuccesfulFields ++;
    }
  }

  // Phone
  if (empty($_POST["phone"])) {
    $phoneErr = "Phone Number is required";
  } else {
    $phone = test_input($_POST["phone"]);
  //  $_SESSION["phone"] = $phone;
    $countOfSuccesfulFields ++;
  }

  if($countOfSuccesfulFields == 5)
  {
    $hashPass = password_hash($pass, PASSWORD_DEFAULT);
    $insertQuery = "INSERT INTO Users (Name, Email, Pass, Phone)
                VALUES ('{$name}', '{$email}', '{$hashPass}','{$phone}')";

    if($conn->query($insertQuery) === TRUE) {
      
      $imgName = basename($_FILES['uploaded_file']['name']);
      $imgTmpName = basename($_FILES['uploaded_file']['tmp_name']);

      $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['uploaded_file']['name']));

      $check = getimagesize($_FILES["uploaded_file"]["tmp_name"]);
      $imageFileType = strtolower(pathinfo($imgName,PATHINFO_EXTENSION));

      /*
      $imgName = $_FILES['uploaded_file']['name'];
      $target_dir = "upload/";
      $target_file = $target_dir . basename($_FILES["uploaded_file"]["name"]);
      // Select file type
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      */

      // Valid file extensions
      $extensions_arr = array("jpg","jpeg","png","gif");
      
      
      // Check extension
      //if( in_array($imageFileType,$extensions_arr ) )
        /*
        $institutionSQL = "SELECT ID FROM Users WHERE Email ='$email' ";
        $institutionResult = $conn->query($institutionSQL);
        $institiutionDetail = $institutionResult->fetch_assoc();
        $instID = $institiutionDetail["ID"];
        // Insert record
        $query = "INSERT INTO Images (InstID, Name)
                 VALUES('{$instID}','{$imgName}')";
        if(mysqli_query($conn,$query) === TRUE)
          echo "successfully uploaded path image to DB";
        else
          echo "Error with uploading path image to DB";

        
        // Upload file
        move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
        */
      if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $uploadfile) && in_array($imageFileType,$extensions_arr ) && $check !== false) {

        $msg = "The institution " . $name . " with an email " . $email . " required a verification. Their phone number is " . $phone . ". Don't forget to come in contact with them";

        $mail = new PHPMailer(TRUE);

        try {
           
          $mail->setFrom('lost.and.found.uom@gmail.com', 'Lost & Found');
          $mail->addAddress('lost.and.found.uom@gmail.com', 'Lost & Found');
          $mail->Subject = $name . ' Waiting to be Verified';
          $mail->Body = $msg;
          $mail->AddAttachment($uploadfile,$imgName);
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
        header("Location: index.php");
      }
      else
        echo "move_uploaded_file Error";
      
      //}
      //else echo "Error1";
    }
      else
        echo "Error2";
  }

}

function test_input($data) {/*copied from www.w3school.com */
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="registerInstitution.css">
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>

<img src="homePageLogo.png" class="logo">

<div class="navbar">
  <ul>
    <li>
    <a class="navButton" href="index.html"><i class="fa fa-fw fa-home">
    </i>Home</a>
    </li>

    <li>
    <a class="navButton" href="registration.html"><i class="fa fa-key"></i>Register</a>
    </li>

  <li>
    <a class="navButton" href="info.html"><i class="fa fa-info-circle"></i>About</a>
    </li>

  </ul>
</div>

<div class="gridContainer">
  <div class="gridItem">
    <h1><legend align="center"><b>Register an institution</b></legend></h1>
  <br>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data">
      <span class="error">* <?php echo $nameErr;?> </span>
      <label for="name">Name of the institution</label>
      <input type="text" name="name" placeholder="The name of the institution..">

    <span class="error">* <?php echo $emailErr;?> </span>
      <label for="email">Email</label>
      <input type="text" name="email" placeholder="Email..">

    <span class="error">* <?php echo $nameErr;?> </span>
      <label for="name">Password</label>
      <input type="password" name="pass" placeholder="Password..">

    <span class="error">* <?php echo $nameErr;?> </span>
      <label for="name">Confirm Password</label>
      <input type="password" name="pass2" placeholder="Confirm Password..">

    <span class="error">* <?php echo $phoneErr;?> </span>
      <label for="phone">Phone</label>
      <input type="tel" name="phone" placeholder="Phone..">

    <label for="type">Type of institution<label>
    <select class="select" name="option">
      <option value="type" selected>
      Choose the type of the institution</option>
    <option value="building">Buildings</option>
    <option value="museum">Museums</option>
    <option value="cafe">Cafes</option>
    <option value="restaurant">Restaurants</option>
    <option value="university">Universities</option>
    <option value="store">Stores</option>
    <option value="park">Parks</option>
    <option value="library">Libraries</option>
    <option value="publicPlace">Public places</option>
    <option value="other">Other</option>
    </select>

    <p>
    <label for="institutionImage">Upload a photo for your institution</label>
    <br>
    <input type="file" id="uploaded_file" name='uploaded_file' accept="image/*">
    </p>

    <label class="termsAndCond">I have read and agree to the
      <a href="terms.html"> Terms and conditions</a> and the
    <a href="privacy.html"> Privacy Policy.</a>
      <input type="checkbox">
      <span class="checkmark"></span>
      </label>

      <input class="buttons" type="submit" value="Register" name="Register">
    </form>
  </div>
</div>

</body>
</html>