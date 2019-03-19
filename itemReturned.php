<?php
  include_once "db_connection.php";

  $id = $_GET['matchedID'];
  $sql = "UPDATE Matched SET Status = '1' WHERE ID = '$id'";
?>
