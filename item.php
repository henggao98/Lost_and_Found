<div class="card"><h2>
<?php echo $row["ItemName"]; ?>
</h2><p class="outset"><h4>
<?php echo $row["Location"] . ', ' . $row["Date"]; ?>
</h4></p><p>
<?php echo $row["Descript"]; ?>  
</p>
<div>
  <a href="claimItem.php?itemId=<?php echo($row['ID']); ?>&mislayerID=<?php echo($_SESSION['id']) ?>">Claim Item</a>
</div>
</div>