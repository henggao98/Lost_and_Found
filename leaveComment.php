<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once "vendor/autoload.php";
  include 'db_connection.php';

  session_start();

  if(isset($_GET['itemID']) && isset($_GET['CommenterID']) && isset($_GET['CommentedID']) && !empty($_POST['rate']) && $_GET['CommenterID'] == $_SESSION["id"] && !empty($_POST["textArea"]))
  {
    $itemID = test_input($_GET["itemID"]);
    echo "Item ID: " . $itemID;
    $commenterID = test_input($_GET['CommenterID']);
    echo "CommenterID" . $commenterID;
    $commentedID = test_input($_GET['CommentedID']);
    echo "CommentedID" . $commentedID;
    $rating = test_input($_POST['rate']);
    $comment = test_input($_POST["textArea"]);

    $matchedSQL = "SELECT * FROM Matched WHERE MislayerID='$commenterID' AND FinderID='$commentedID' AND ItemID='$itemID' AND Status='1'";
    $matchedResult = $conn->query($matchedSQL);
    
    if($matchedResult->num_rows > 0)
    {

      $commentInsertQuery = "INSERT INTO Ratings (CommenterID, CommentedID, Rating, Comment) VALUES ('{$commenterID}', '{$commentedID}', '$rating', '{$comment}')";


      if($conn->query($commentInsertQuery) === TRUE)
      {

        $ratingSQL = "SELECT Rating FROM Ratings WHERE CommentedID='$commentedID'";
        $ratingResult = $conn->query($ratingSQL);
        $ratingSoFar = 0;
        $count = 0;
        while ($ratingRow = $ratingResult->fetch_assoc()) 
        {
          $ratingSoFar += (int)$ratingRow['Rating'];
          $count++;
        }
        $userRating = (float)$ratingSoFar / $count;
        $userRating = round($userRating, 1);

        $insertRating = "UPDATE Users SET Rating='$userRating' WHERE ID='$commentedID'";

        if($conn->query($insertRating) === TRUE)
        {

          $commentedSQL = "SELECT Name, Email FROM Users WHERE ID='$commentedID'";
          $commentedResult = $conn->query($commentedSQL);
          $commentedRow = $commentedResult->fetch_assoc();

          $commenterSQL = "SELECT Name, Email FROM Users WHERE ID='$commenterID'";
          $commenterResult = $conn->query($commenterSQL);
          $commenterRow = $commenterResult->fetch_assoc();

          $msg = "You received a new comment from " . $commenterRow["Name"] . " saying \'" . $comment . " \'.";
          $mail = new PHPMailer(TRUE);

          try {
             
             $mail->setFrom('lost.and.found.uom@gmail.com', 'Lost & Found');
             $mail->addAddress($commentedRow['Email'], $commentedRow['Name']);
             $mail->Subject = 'New comment on your Lost & Found Account';
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


          header("Location: itemRecieved.php?itemID=" . $itemID);
        }
        else
        {
          echo "Insert rating error";
        }
      }
      else
      {
        echo "Insert ERROR. You will be redirected to the account page in 5 seconds";
        sleep(5);
        //header("Location: account.php");
      }
    }
    else
    {
      echo "No matching Result. You will be redirected to the account page in 5 seconds";
      sleep(5);
      //header("Location: account.php");

    }
  }
  else
    echo "Get variables Error. You will be redirected to the account page in 5 seconds";
    sleep(5);
    //header("Location: account.php");

  function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>  