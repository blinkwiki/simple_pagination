<?php
/**
* Support functions for CRUD.
*
* @package    support.php
* @subpackage 
* @author     BlinkWiki
* @version    1.0
* Copyright 2016 BlinkWiki
* 
*/
?>
<?php

    

/**
*
* This function generates the pagination links for the READ page of a submission table
*
* IN
* $tbl is the mysql table
* $conn is mysql connection resource
*
* OUT : Array
* 'page_link_html' HTML First Previous Next and Last links
* 'page_num' current page number
* 'page_rows' number records in page
* 'start_row' => the row index to start counting records
* 'stop_row' => the row index to stop counting records
* 'total_pages' => total number of pages for the current rows per page
*
*/

function get_pages($tbl, $conn)
{
    
    // get the page number form GET
    $page_num = mysql_real_escape_string($_GET['page_num']);
    // make default page 0
    $page_num = ($page_num > 0) ? $page_num : 0;

    // get rows per page form GET
    $page_rows = mysql_real_escape_string($_GET['page_rows']);
    // make default rows per page 20
    $page_rows = ($page_rows > 0) ? $page_rows : 20;

    
    // total number of records in the table
    {
        // the query for total number of records in table
        $sql_total = 'SELECT COUNT(*) FROM '.$tbl.' WHERE 1';
        
        // submit the query
        $rs = mysql_query($sql_total, $conn) or die(mysql_error());

        // fetch the first 
        $row = mysql_fetch_assoc($rs);

        // total rows is found in the COUNT(*) field
        $total_rows = $row['COUNT(*)'];
    }
    
    // calculate total pages
    $total_pages = floor($total_rows / $page_rows);
    
    // the conditions for first and last pages
    $is_first_page= ($page_num <= 0);
    $is_last_page = ($page_num >= $total_pages);
    
    // claculate start and stop rows
    // loop start row
    $start_row = $page_num * $page_rows;
    // loop stop row
    $stop_row = $start_row + $page_rows;
    if ($is_last_page)
    {
        // the stop row should be the last record in the table
        // - 1 is to correct for the loop starting from zero
        $stop_row = $total_rows - 1;
    }
    
    // html links
    {
        $first_link = ($is_first_page) ? 'First' : '<a href="?">First</a>';

        $prev_link = ($is_first_page) ? 'Previous' : '<a href="?'.@page_num.'='.($page_num - 1).'&'.@page_rows.'='.$page_rows.'">Previous</a>';

        $next_link = ($is_last_page) ? 'Next' : '<a href="?'.@page_num.'='.($page_num + 1).'&'.@page_rows.'='.$page_rows.'">Next</a>';

        $last_link = ($is_last_page) ? 'Last' : '<a href="?'.@page_num.'='.$total_pages.'">Last</a>';
    }
    
    // combine strings
    $plinks = ''
        . $first_link.' &nbsp;'
        . $prev_link.' &nbsp;'
        . $next_link.' &nbsp;'
        . $last_link
    ;
    
    $res = array(
        'page_link_html' => $plinks
        , 'page_num' => $page_num
        , 'page_rows' => $page_rows
        , 'start_row' => $start_row
        , 'stop_row' => $stop_row
        , 'total_pages' => $total_pages
    );
    
    // return the result
    return $res;
    
}

?>