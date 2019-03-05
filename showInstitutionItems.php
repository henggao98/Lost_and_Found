<?php    

$counter = 0;
// COUNTING THE ITEMS.
while($row = $result->fetch_assoc()){
        if(empty($category) && empty($searched))
            $counter++;
        elseif(!empty($category) && empty($searched) && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false)
            $counter++;
        elseif(empty($category) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false)
            $counter++;
        elseif(!empty($category) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false) 
            $counter++;
}

if($totalItems != $counter){
    $totalItems = $counter;
    $totalPages = ceil($totalItems / $itemsPerPage);
}

$startItemIndex = ($currentPage-1) * ($itemsPerPage);
$counter = 0;
$index = -$startItemIndex;
$endItemIndex = $currentPage * $itemsPerPage;

$result1 = $conn->query($sql);

// SHOWING THE ITEMS.
while($row = $result1->fetch_assoc()){
    if($counter < $totalItems && $counter < $itemsPerPage && $index >= 0)
    {
        if(empty($category) && empty($searched))
        { 
            include 'item.php';
            $counter++;
            $indexCounterState = 0;
        }
        elseif(!empty($category) && empty($searched) && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false)
        {
            include 'item.php'; 
            $counter++;
            $indexCounterState = 1;
        }

        elseif(empty($category) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false)
        {
            include 'item.php';
            $counter++;
            $indexCounterState = 1;
        }

        
        elseif(!empty($category) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false)
        {
            include 'item.php';
            $counter++;
            $indexCounterState = 1;
        }
    }
    $index++;
}

?>