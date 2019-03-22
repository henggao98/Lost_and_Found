

<style>
.checked {
    color: orange;
}
  </style>

<p><b>Name: </b><?php echo $userRow["Name"]; ?></p>
<p><b>Email: </b><?php echo $userRow["Email"]; ?></p>
<?php
  if($userRow["Phone"] == null)
  {
?>
  <p>
  <form method="post" action="phoneNumber.php">
    <input type="text" name="phone" placeholder="Phone number..">
    <input class="button2" type="submit" value="Submit">
  </form>
  </p>
<?php
  }else
  {
?>
<p><b>Phone Number: </b> <?php echo $userRow["Phone"]; ?> </p>
<?php } ?>
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

