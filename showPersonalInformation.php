<h4>
<?php echo "Name: " . $userRow["Name"]; ?>
</h4><h4>
<?php echo "Email: " . $userRow["Email"]; ?>
</h4><h4>
<?php
  if($userRow["Phone"] == null)
  {
?>
  <form method="post" action="phoneNumber.php">
    Phone: <input type="text" name="phone" placeholder="Phone number..">
    <input class="button2" type="submit" value="Submit">
  </form>
<?php
  }else
    echo "Phone number: " . $userRow["Phone"]; ?>

</h4>

