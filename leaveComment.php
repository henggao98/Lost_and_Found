<?php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;

  require_once "vendor/autoload.php";
  include 'db_connection.php';

  session_start();

  if(isset($_GET["matchedRow"]) && isset($_GET['itemID']) && isset($_GET['CommenterID']) && isset($_GET['CommentedID']) && $_GET['CommenterID'] == $_SESSION["id"] && !empty($_POST["textArea"]))
  {
    $matchedRow = $_GET["matchedRow"];
    $itemID = $_GET["itemID"];
    $commenterID = $_GET['CommenterID'];
    $commentedID = $_GET['CommentedID'];
    //$rating
    $comment = test_input($_POST["textArea"]);

    $matchedSQL = "SELECT * FROM Matched WHERE CommenterID='$commenterID' AND CommentedID='commentedID' AND ItemID='$itemID'";
    $matchedResult = $conn->query($matchedSQL);
    
    if($matchedResult->num_rows > 0)
    {

      $commentInsertQuery = "INSERT INTO Ratings (CommenterID, CommentedID, Rating, Comment) VALUES ('{$commenterID}', '{$commentedID}', '3', '{$comment}')";

      if($conn->query($commentInsertQuery) === TRUE)
      {
        $commentedSQL = "SELECT * FROM Users WHERE ID='$commentedID'";
        $commentedResult = $conn->query($commentedSQL);
        $commentedRow = $commentedResult->fetch_assoc();

        $commenterSQL = "SELECT * FROM Users WHERE ID='$commenterID'";
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


        header("Location: itemRecieved.php?itemID=" . $itemID . "&matchedID=" . $matchedRow);
    
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
  //$data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>  