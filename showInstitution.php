<!--
<a style="display: block; text-decoration: none !important;" href="<?php echo $link . $row['ID']; ?>">
//-->
<?php 
$rowID = $row["ID"];

$sqlImage = "SELECT Image FROM Images where InstID = '$rowID'";
$sth = $conn->query($sqlImage);
$imageRow = mysqli_fetch_array($sth);

$image = $imageRow['Image'];
//$image_src = "upload/".$image;

if($counter == 1) echo "<div class='row'>";
?>
<div class="column">
<div class="card"><div class="container2"><h2>
<?php echo $row["Name"]; ?>
</h2><p class="outset"></p>>
<?php echo '<img src="data:image/jpeg;base64,'.base64_encode( $image ).'"/>'; ?>
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