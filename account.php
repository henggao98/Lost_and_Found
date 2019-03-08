<?php

//A php file to access and display relevent account information
//Server information

  session_start();
  
//Include the file which establishes and checks database conection

  include_once 'db_connection.php';


//Check that the user is logged in, if not disconnect

  if($_SESSION["loggedIn"] == 0)
    {
      echo "You are not logged in";
      $conn->close();
    }//if


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
      echo "Your account information: <br><br>";
      echo "Name: " . $userRow["Name"] . "<br>";
      echo "Email: " . $userRow["Email"] . "<br>";
      if($userRow["Rating"] == null)
        echo "Rating: You haven't got a rating yet <br>";
      else
        echo "Rating: " . $userRow["Rating"] . "<br>";
      if($userRow["Phone"] == null)
        echo "Phone: Implement a way to input phone <br><br>";
      else
        echo "Phone: " . $userRow["Phone"] . "<br><br>";
      $accountFound = true;
    }//if
  }//while

  if(!$accountFound)
  {
    echo "Your account cannot be found, please contact Kaloyan";
    $conn->close();
  }//if


//Select any relevant found items on the site and display it's information
 
  $foundItems = 0;
  $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
  $itemsResult = $conn->query($sql);

  echo "Found items: <br><br>";
  while($itemsRow = $itemsResult->fetch_assoc())
  {
    if($itemsRow["FinderId"] == $sessionId)
    {
      $isMatched = false;   
      $sql = "SELECT FinderID, MislayerID, ItemID FROM Matched";
      $matchedResult = $conn->query($sql);

      while($matchedRow = $matchedResult->fetch_assoc())
      {
        if($matchedRow["FinderID"] == $sessionId && $matchedRow["ItemID"] == $itemsRow["ID"])
        {
          $isMatched = true;
        }//if
      }//while
        
      if(!$isMatched)
      {
        $foundItems++;
        echo "Item: " . $foundItems . "<br>";
        printItem($itemsRow["ItemName"], $itemsRow["Descript"], $itemsRow["Location"], 
                  $itemsRow["Date"]);
      }//if 
    }//if
  }//while

  if($foundItems == 0)
    echo "You haven't found anything";

 
//Select any matched items and display them

  $matchedItems = 0;
  $sql = "SELECT FinderID, MislayerID, ItemID FROM Matched";
  $matchedResult = $conn->query($sql);
  echo "Matched items: <br><br>";
  
  while($matchedRow = $matchedResult->fetch_assoc())
  {
    if($matchedRow["MislayerID"] == $sessionId || $matchedRow["FinderID"] == $sessionId)
    {
      $sql = "SELECT ID, FinderId, ItemName, Descript, Location, Date FROM Items";
      $itemsResult = $conn->query($sql);

      while($itemsRow = $itemsResult->fetch_assoc())
      {
        if($itemsRow["ID"] == $matchedRow["ItemID"])
        {
          $matchedItems++;        
          echo "Matched Item: " . $matchedItems . "<br>";
          printItem($itemsRow["ItemName"], $itemsRow["Descript"], $itemsRow["Location"], 
                    $itemsRow["Date"]);
        }//if
      }//while
    }//if
  }//while
 
  if($matchedItems == 0)
  {
    echo "You have no matched items <br><br>";
  }//if


//Select and print the relevent ratings
  $sql = "SELECT CommenterID, CommentedID, Rating, Comment FROM Ratings";
  $ratingsResult = $conn->query($sql);
  $noOfRatings = 0;
  echo "Your ratings: <br><br>";

  while($ratingsRow = $ratingsResult->fetch_assoc())
  {
    if($ratingsRow["CommentedID"] == $sessionId)
    {
      echo "Rating " . $ratingsRow["Rating"] . ": <br>";
      echo "Comment: " . $ratingsRow["Comment"] . "<br>";
      $sql = "SELECT ID, Name, Email FROM Users";
      $userResult = $conn->query($sql);
      while($userRow = $userResult->fetch_assoc())
      {
        if($ratingsRow["CommenterID"] == $userRow["ID"])
        {
          echo "Commenter name: " . $userRow["Name"] . "<br>";    
          echo "Commenter E-mail: " . $userRow["Email"] . "<br>";  
        }//if    
      }//while
    $noOfRatings++;  
    }//if
  }//while
   
  if($noOfRatings == 0)
  {
    echo "You don't have any reviews";
  }//if


//A function to print out an Item, for a corresponding ID
  function printItem($name, $descript, $location, $date)
  {
      echo "Item name: " . $name . "<br>";
      echo "Decription: " . $descript . "<br>";
      echo "Location: " . $location . "<br>";
      echo "Date and time found: " . $date . "<br><br>";
  }//printItems
?>
