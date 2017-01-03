<?php //*********************************************READ ?>
    
    <hr>
    
    <strong>Read Airports</strong><br><br>
    
    <?php

        // the table name
        $tbl = 'tbl_airports';
        
        // get the pagination links
        $pagination_links = get_pages($tbl, $conn);
        
        // build the read query
        $sql = get_read_sql($tbl)
            
            // arrange by code
            .' ORDER BY `airport_code` ASC'
            
            // implement the pagination using LIMIT
            .' LIMIT '.$pagination_links['start_row'].', '.$pagination_links['page_rows']
            
            ;

        // process the sql for table
        $mysql_res = send_sql($sql, $conn);

        // get the first row
        $row = $mysql_res['first_row'];
        
    ?>
    
    <?php // display the table ?>
    <table width="100%">
        <thead class="fw_b" valign="top">
            <tr>
                <td width="5%">SN</td>
                <td width="10%">CODE</td>
                <td width="10%">IATA</td>
                <td>Airport Name</td>
                <td>City</td>
                <td>Country</td>
                <td width="10%" align="center">Actions</td>
            </tr>
        </thead>
        <tbody valign="top">
        <?php
            // display the table contents
            for ($i=$pagination_links['start_row']; $i<$pagination_links['stop_row']; $i++)
            {
        ?>
            <tr>
                <td><?php echo $i+1; ?></td>
                <td><?php echo $row['airport_code']; ?></td>
                <td><?php echo $row['airport_iata_code']; ?></td>
                <td><?php echo utf8_encode($row['airport_desc']); ?></td>
                <td><?php echo utf8_encode($row['airport_city']); ?></td>
                <td><?php echo utf8_encode($row['airport_notes']); ?></td>
                <td align="center">...</td>
            </tr>
            <?php $row = mysql_fetch_assoc($mysql_res['rs']); ?>
        <?php } ?>
        </tbody>
        <tfoot>
            <tr align="center">
                <td colspan="7">
                    <?php echo $pagination_links['page_link_html']; ?>
                </td>
            </tr>
        </tfoot>
    </table>
    
    <?php // display the table ?>
    
<?php //*********************************************READ ?>