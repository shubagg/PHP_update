<?php
      $per_page=$data['limit'];
      $page=$data['page'];
      $total = $data['totalrecord'];
      $adjacents = "2"; 
      $page = ($page == 0 ? 1 : $page);  
      $start = ($page - 1) * $per_page;               
      $prev = $page - 1;              
      $next = $page + 1;
      $setLastpage = ceil($total/$per_page);
      $lpm1 = $setLastpage - 1;
      
      $setPaginate = "";
      if($setLastpage > 1)
      { 
        $setPaginate .= "<ul class='pagination pull-right'>";
        if ($setLastpage < 7 + ($adjacents * 2))
        { 
          for ($counter = 1; $counter <= $setLastpage; $counter++)
          {
            if ($counter == $page)
              $setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
            else
              $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$counter'>$counter</a></li>";          
          }
        }
        elseif($setLastpage > 5 + ($adjacents * 2))
        {
          if($page < 1 + ($adjacents * 2))    
          {
            for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
            {
              if ($counter == $page)
                $setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
              else
                $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$counter'>$counter</a></li>";          
            }
            $setPaginate.= "<li><a href='#'>...</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$lpm1'>$lpm1</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$setLastpage'>$setLastpage</a></li>";    
          }
          elseif($setLastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
          {
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='1'>1</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='2'>2</a></li>";
            $setPaginate.= "<li><a href='#'>...</a></li>";
            for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
            {
              if ($counter == $page)
                $setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
              else
                $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$counter'>$counter</a></li>";          
            }
            $setPaginate.= "<li><a href='#'>...</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$lpm1'>$lpm1</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$setLastpage'>$setLastpage</a></li>";    
          }
          else
          {
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='1'>1</a></li>";
            $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='2'>2</a></li>";
            $setPaginate.= "<li><a href='#'>...</a></li>";
            for ($counter = $setLastpage - (2 + ($adjacents * 2)); $counter <= $setLastpage; $counter++)
            {
              if ($counter == $page)
                $setPaginate.= "<li class='active'><a class='current_page'>$counter</a></li>";
              else
                $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$counter'>$counter</a></li>";          
            }
          }
        }   
      }
      if ($page < $counter - 1)
      { 
              $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$next'>Next</a></li>";
              $setPaginate.= "<li><a href='javascript:void(0)' class='PaginationLink' id='$setLastpage'>Last</a></li>";
      }
      
     echo $setPaginate.= "</ul>\n";
    
?>