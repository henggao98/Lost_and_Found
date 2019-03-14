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
?>
