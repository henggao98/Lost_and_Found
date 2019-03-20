<?php
  session_start();
  include_once 'db_connection.php';

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    $number = $_REQUEST['phone'];
    $id = $_SESSION['id'];

    $sql= "UPDATE Users SET Phone = '$number' WHERE ID = '$id'";
    $conn->query($sql);

    header("Location: account.php");
  }
?>
