<?php
  echo '<a href="?page=' . ($currentPage - 1) . '">&laquo;</a>';

  if($totalPages == 0)
    echo '<a href="?page=1" class="active">1</a>';
  else{
    foreach(range(1, $totalPages) as $page){
      // Check if we're on the current page in the loop
      if($page == $_GET['page']){
          echo '<a href="?page=' . $page . '" class="active">' . $page . '</a>';
      }else{
          echo '<a href="?page=' . $page . '">' . $page . '</a>';
      }
    }
  }
  echo '<a href="?page=' . ($currentPage + 1) . '">&raquo;</a>';
    /* else if($page == 1 || $page == $totalPages || ($page >= $_GET['page'] - 2 && $page <= $_GET['page'] + 2))   */

  
?>