<?php

//A php file to access and display relevent account information
//Server information

  session_start();
  $servername = "dbhost.cs.man.ac.uk";
  $username = "j78532kt";
  $password = "kaloyandb";
  $dbname = "2018_comp10120_z8";
  $conn = new mysqli($servername, $username, $password);

//Check the connection

  if (!$conn)
  {
    die("Connection failed: " . mysqli_connect_error());
  } //if

//Check that the user is logged in, if not disconnect

  if($_SESSION["loggedIn"] == 0)
  {
    echo "You are not logged in";
    $conn->close;
  }//if

//A variable representing of the account has been found
  $accountFound = false;

//Set up an SQL query to select user information, and display if the correct user
  $sql = "SELECT ID, Name, Email, Rating, Phone FROM Users";
  $userResult = $conn->query($sql);
  echo "Account information: <br>";

  while($userRow = $userResult->fetch_assoc())
  {
    if($userRow["ID"] == $_SESSION["id"])
    {
      echo "Your account information: <br>";
      echo "Name: " . $userRow["Name"] . "<br>";
      echo "Email: " . $userRow["Email"] . "<br>";
      echo "Rating: " . $userRow["Rating"] . "<br>";
      echo "Phone: " . $userRow["Phone"] . "<br>";
      $accountFound = true;
    }//if
  }//while

  if(!accountFound)
  {
    echo "Your account cannot be found, please contact Kaloyan";
    $conn->close;
  }//if

//Select any relevant found items on the site, the following vaiable shows if any items
//have been found
  
  $itemNumber = 1;
  $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
  $itemsResult = $conn->query($sql);

  echo "Found items: <br>";

  while($itemsRow = $itemsResult->fetch_assoc())
  {
    if($itemsRow["FinderId"] == $_SESSION["id"])
    {
      echo "Item " . $itemNumber . "<br>";
      echo "Item name: " . $itemsRow["ItemName"] . "<br>";
      echo "Decription: " . $itemsRow["Descript"] . "<br>";
      echo "Location: " . $itemsRow["Location"] . "<br>";
      echo "Date found: " . $itemsRow["Date"] . "<br>";
      $itemNumber++;
    }//if
  }//while

  if($itemNumber == 1)
  {
    echo "You haven't found anything";
  }//if

//Select any matched items, the following variables indicates how many matches found
  $matchedItemNumber = 1;
  $sql = "SELECT FinderID, MislayerID, ItemID FROM Matched";
  $matchedResult = $conn->query($sql);

  echo "Matched items: <br>";
  
  while($matchedRow = $matchedResult->fetch_assoc())
  {
    if($matchedRow["FinderID"] == $_SESSION["id"] || $matchedRow["FinderID"] ==
    $_SESSION["id"])
    {
      while($itemsRow = $itemsResult->fetch_assoc())
      {
        if($itemsRow["ID"] == $matchedRow["ItemID"])
        {
          echo "Matched Item: " . $matchedItemNumber . "<br>";
          echo "Item name: " . $itemsRow["ItemName"] . "<br>";
          echo "Decription: " . $itemsRow["Descript"] . "<br>";
          echo "Location: " . $itemsRow["Location"] . "<br>";
          echo "Date found: " . $itemsRow["Date"] . "<br>";
          $matchedItemNumber++;
        }//if
      }//while
    }//if
  }//while

  if($matchedItemNumber == 1)
  {
    echo "You have no matched items";
  }//if

//Select the relevant reviews
  $sql = "SELECT CommenterID, CommentedID, Rating, Comment FROM Ratings";
  $ratingsResult = $conn->query($sql);

//A variable to represent if the user has any reviews
  $anyReviews = false;
  echo "Your ratings: <br>";

  while($ratingsRow = $ratingsResult->fetch_assoc())
  {
    if($ratingsRow["CommentedID"] == $_SESSION["id"])
    {
      echo "Rating: " . $ratingsRow["Rating"] . "<br>";
      echo "Comment: " . $ratingsRow["Comment"];
    
//This will in future get the name of the corresponding commenter ID
    
      echo "Commenter ID: " . $ratingsRow["CommenterID"] . "<br>";
      $anyReviews = true;
    }//if
  }//while
   
  if(!$anyReviews)
  {
    echo "You don't have any reviews";
  }//if
?>
