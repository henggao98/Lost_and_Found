<?php
//Set up an SQL query to select user information, check if the account
//can be found and display the correct user information if so

  $accountFound = false;
  $sql = "SELECT ID, Name, Email, Rating, Phone FROM Users";
  $userResult = $conn->query($sql);
  $sessionId = $_SESSION["id"];

  while($userRow = $userResult->fetch_assoc())
  {
    if($userRow["ID"] == $sessionId)
    {
      include "showPersonalInformation.php";
      $accountFound = true;
    }//if
  }//while

  if(!$accountFound)
  {
    echo "Your account cannot be found, please contact Kaloyan";
    $conn->close();
  }//if
?>
