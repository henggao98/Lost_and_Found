<?php
  include_once "db_connection.php";
  session_start();

  if(!isset($_SESSION["loggedIn"]))
    header("Location: index.php");
  else if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == 0)
    header("Location: index.php");
?>

<!DOCTYPE html>

  <html>
  <title>Comments Page</title>
  <head><link rel="stylesheet" href="items.css"></head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css' integrity='sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ' crossorigin='anonymous'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <style>
  .checked {
    color: orange;
}
  </style>

  <body>

  <div class="logo">
    <b> Lost & Found </b>
  </div>

  <div class="topnav">
    <a href="index.php" style="float:right"><i class="fa fa-fw fa-home"></i>Home</a>
    <a href="account.php" style="float:right"><i class="fa fa-fw fa-user"></i>Account</a>
    <a href="institutions.php" style="float:right"><i class="fa fa-fw fa-globe"></i>Search Places</a>
    <a href="items.php" style="float:right"><i class="fa fa-fw fa-search"></i>Search Items</a>
    <a href="found.php" style="float:right"><i class='fas fa-hand-holding-heart'></i>Found Something</a>
  </div>

<?php
  $id = $_GET["id"];
  $sqlUser = "SELECT Name, Rating FROM Users WHERE ID = '$id'";
  $userResult = $conn->query($sqlUser);
  $userRow = mysqli_fetch_assoc($userResult);
?>

<div class="row">
  <div class="leftcolumn">

  <div class="card">
    <p><b>Name: </b> <?php echo($userRow["Name"]) ?></p>
    <p><b>Rating: </b>
    <?php
    $stars = round($userRow["Rating"]);
    for($index = 0; $index < $stars; $index++)
    {
    ?>
      <span class = "fa fa-star checked"></span>
    <?php } ?>
    <?php
    for($index = 0; $index < (5 - $stars); $index++)
    { ?>
      <span class = "fa fa-star"></span>
    <?php
    }
    echo '(' . round($userRow["Rating"], 1) . ')';
    ?>
  </p>
  </div>
  </div>

  <div class="rightcolumn">
<?php
  $sqlComment = "SELECT * FROM Ratings";
  $commentResult = $conn->query($sqlComment);
  $noOfComments = 0;

  while($commentRow = $commentResult->fetch_assoc())
  {
    if($commentRow["CommentedID"] == $id) 
    {
      $sql = "SELECT ID, Name FROM Users";
      $result = $conn->query($sql);

      while($row = $result->fetch_assoc())
      {
        if($row["ID"] == $commentRow["CommenterID"])
        {
?>
          <div class="card">
          <h2>
            <?php echo $row["Name"]; ?>
          </h2>

         <p class = "outset"><h4>
           <?php
           $stars = round($commentRow["Rating"]);
           for($index = 0; $index < $stars; $index++)
           {
           ?>
           <span class = "fa fa-star checked"></span>
           <?php } ?>
          <?php
          for($index = 0; $index < (5 - $stars); $index++)
          { ?>
          <span class = "fa fa-star"></span>
          <?php
          } ?>
          <br>
            <?php echo $commentRow["Comment"]; ?>
          </h4>
          </p>
          </div>
<?php
          $noOfComments++;
        }//if
      }//while
    }//if
  }//while

  if($noOfComments == 0)
    echo "This user has no comments";
?>
</div>
