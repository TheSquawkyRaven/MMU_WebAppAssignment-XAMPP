<?php
    require 'connect.php';

    /*
    <ul>
        <li><span class="pagination-btn" value="first">&larr; Prev</span></li>
        <li><span class="pagination-btn" value="1">1</span></li>
        <li>...</li>
        <li><span class="pagination-btn">13</span></li>
        <li><span class="pagination-btn current">14</span></li>
        <li><span class="pagination-btn">15</span></li>
        <li>...</li>
        <li><span class="pagination-btn">20</span></li>
        <li><span class="pagination-btn" value="last">&rarr; Next</span></li>
    </ul>
    */

    $output = '';
    $output .= '<ul>';

    $current = $_POST['current'];
    $max = $_POST['max'];
    $table = $_POST['table'];
    $condition = $_POST['condition'];

    $current_offset = ($current - 1) * $max;

    $sql = $con->query("SELECT * FROM ".$table." ".$condition); // SELECT * FROM XXX

    if(!$sql) echo '<script>alert("ERROR: " + "'.$_POST['sql'].'");</script>';

    $total_btn = ceil(($sql->num_rows) / $max);
    //echo '<script>alert("ERROR: " + "'."SELECT * FROM ".$table." ".$condition." LIMIT $current_offset, $max".' " + "Total: " + "'.$total_btn.'");</script>';

    if($total_btn > 5) {
        if($current != 1 && $current != $total_btn) { // <- prev 1..2 3 4..5next ->
            //echo '<script>alert("Current: " + "'.$current.'")</script>';
            $output .= '<li><span class="pagination-btn" value="prev">&larr; Prev</span></li>';
            $output .= '<li><span class="pagination-btn" value="1">1</span></li>';
            if(!(($current - 1) == 1 || ($current - 2) == 1)) // second or third page, no need ...
                $output .= '<li>...</li>';

            $count = 3;
            for($i = 2; $i <= $total_btn - 1; $i++) {
                if($i == $current || $i == $current - 1 || $i == $current + 1) {
                    $class = '';
                    if($i == $current) $class = 'class="pagination-btn current"';
                    else $class = 'class="pagination-btn"';

                    $output .= '<li><span '.$class.' value="'.$i.'">'.$i.'</span></li>';
                }
            }

            if(!(($current + 1) == $total_btn || ($current + 2) == $total_btn)) // last 2 or 3 page, also no need ...
                $output .= '<li>...</li>';

            $output .= '<li><span class="pagination-btn" value="'.$total_btn.'">'.$total_btn.'</span></li>';
            $output .= '<li><span class="pagination-btn" value="next">&rarr; Next</span></li>';
        }else { // 1..2 3 4..5next -> or <- prev 1..2 3 4..5
            if($current == 1) { // first page
                $output .= '<li><span class="pagination-btn current" value="1">1</span></li>';

                for($i = 2; $i <= 4; $i++)
                    $output .= '<li><span class="pagination-btn" value="'.$i.'">'.$i.'</span></li>';

                if(!(($current + 1) == $total_btn || ($current + 2) == $total_btn)) // last 2 or 3 page, also no need ...
                    $output .= '<li>...</li>';

                $output .= '<li><span class="pagination-btn" value="'.$total_btn.'">'.$total_btn.'</span></li>';
                $output .= '<li><span class="pagination-btn" value="next">&rarr; Next</span></li>';
            }else { // last page
                $output .= '<li><span class="pagination-btn" value="prev">&larr; Prev</span></li>';
                $output .= '<li><span class="pagination-btn" value="1">1</span></li>';

                if(!(($current - 1) == 1 || ($current - 2) == 1)) // second or third page, no need ...
                    $output .= '<li>...</li>';

                for($i = $total_btn - 3; $i < $total_btn; $i++)
                    $output .= '<li><span class="pagination-btn" value="'.$i.'">'.$i.'</span></li>';

                    $output .= '<li><span class="pagination-btn current" value="'.$total_btn.'">'.$total_btn.'</span></li>';
            }
        }
    }else {
        $output .= '<li><span class="pagination-btn" value="prev">&larr; Prev</span></li>';
        for($i = 1; $i <= $total_btn; $i++) {
            $class = '';
            if($i == $current) $class = 'class="pagination-btn current"';
            else $class = 'class="pagination-btn"';

            $output .= '<li><span '.$class.' value="'.$i.'">'.$i.'</span></li>';
        }
        $output .= '<li><span class="pagination-btn" value="next">Next &rarr;</span></li>';
    }

    echo $output;
?>