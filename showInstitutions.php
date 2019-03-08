<?php
$counter = 1;
while($row = $result->fetch_assoc()){
  //$link = "./institution.php?id=";
  if(empty($searched) && empty($location))
  {
    include 'showInstitution.php';
  }
  elseif(!empty($searched) && empty($location) && strpos(strtolower($row["Name"]), strtolower($searched)) !== false)
  {
    include 'showInstitution.php';
  }
  elseif (empty($searched) && !empty($location) && strpos(strtolower($row["Name"]), strtolower($location)) !== false) 
  {
    include 'showInstitution.php';
  }
  elseif (!empty($searched) && !empty($location) && strpos(strtolower($row["Name"]), strtolower($searched)) !== false && strpos(strtolower($row["Name"]), strtolower($location)) !== false) 
  {
    include 'showInstitution.php';
  }
}

?>