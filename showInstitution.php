<?php 
$rowID = $row["ID"];

$sqlImage = "SELECT Name from Images where InstID={$rowID}";
$resultImage = mysqli_query($conn,$sqlImage);
$rowImage = mysqli_fetch_array($resultImage);

$image = $rowImage['Name'];
$image_src = "upload/".$image;

if($counter == 1) echo "<div class='row'>";
?>
<div class="column">
<div class="card"><div class="container2"><h2>
<?php echo $row["Name"]; ?>
</h2><p class="outset"></p>
<img src='<?php echo $image_src; ?>' >
<p><button  class="button" onclick="window.location.href='<?php echo $link . $rowID; ?>'" >Search Items</button></p>
</div></div></div>
<?php 
if($counter == 3)
  { 
    echo "</div>";
    $counter = 1;
  }
else
  $counter++;
?>