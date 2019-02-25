<?php    
  while($row = $result->fetch_assoc()): 
    
    if(empty($category) && empty($location) && empty($searched)): ?>
        <div class="card"><h2>
        <?php echo $row["ItemName"]; ?>
        </h2><p class="outset"><h4>
        <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
        </h4></p><p>
        <?php echo $row["Descript"]; ?>  
        </p></div>
    <?php 
    elseif(empty($location) && !empty($category) && empty($searched) && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false): ?>
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>
    <?php
    elseif(empty($category) && !empty($location) && empty($searched) && strpos(strtolower($row["Location"]), strtolower($location)) !== false ): ?>
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>
    <?php
    elseif(!empty($category) && !empty($location) && empty($searched) && strpos(strtolower($row["Location"]), strtolower($location)) !== false && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false): ?>
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>
  <?php
    elseif(empty($category) && empty($location) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false): ?>
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>
    
    <?php
    elseif(!empty($category) && empty($location) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false): ?> 
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>
    
    <?php
    elseif(empty($category) && !empty($location) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false && strpos(strtolower($row["Location"]), strtolower($location)) !== false): ?> 
    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>

    <?php
    elseif(!empty($category) && !empty($location) && !empty($searched) && strpos(strtolower($row["Descript"]), strtolower($searched)) !== false && strpos(strtolower($row["Location"]), strtolower($location)) !== false && strpos(strtolower($row["ItemName"]), strtolower($category)) !== false): ?> 

    <div class="card"><h2>
    <?php echo $row["ItemName"]; ?>
    </h2><p class="outset"><h4>
    <?php echo $row["Location"] . ', ' . $row["Date"]; ?>
    </h4></p><p>
    <?php echo $row["Descript"]; ?>  
    </p></div>



  <?php
    endif; 
    endwhile;
    
?>