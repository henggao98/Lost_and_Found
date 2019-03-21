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
