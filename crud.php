<?php
/**
* CRUD Functions.
*
* @package    crud.php
* @subpackage 
* @author     BlinkWiki
* @version    1.0
* Copyright 2016 BlinkWiki
* 
*/
?>
<?php
function send_sql($sql, $conn)
{

    // submit the query to generate rows
    $rs = mysql_query($sql, $conn) or die(mysql_error());

    // fetch the first 
    $row = mysql_fetch_assoc($rs);

    // calculate total rows
    $total_rows = mysql_num_rows($rs);
    
    // get the pagination

    
    // save the values
    $res = array(
        
        // save the mysql resource
        'rs' => $rs
        
        // save the first row
        , 'first_row' => $row
        
        // save the total rows
        , 'total_rows' => $total_rows
    );
    
    // return the values
    return $res;
}

function get_key_fld($tbl, $conn)
{}

function get_create_sql($post, $tbl, $conn)
{}

function get_update_sql($post, $tbl, $conn)
{}

function get_read_sql($tbl)
{
    switch($tbl)
    {
        // you can add more cases (tables) if you wish to. Needed for normalised tables
        case 'tbl_states':
        default:
            $sql = 'SELECT * FROM `'.$tbl.'` WHERE 1';
            
    }
    return $sql;
}

function get_delete_sql($tbl, $rid, $conn)
{
}

function delete_record($tbl, $rid, $conn)
{
}

?>