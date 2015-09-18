<?php
    
    date_default_timezone_set('UTC');

    $date = date('Y-m-01'); // hard-coded '01' for first day
    $end_date  = date('Y-m-t');

?>
</script>
<h3 id='archives'><?php echo date ("F",strtotime($date)); ?></h3> 
<hr>
<i>*double click cell to edit</i>

<input type='hidden' id='hidden-cell' name='cell'>


<?php
    
    $concat = '';

    $tableHeader = '';
    
 $tableHeader .= "<div id='div-shift' style='overflow: scroll;width:120%;height:120%;' class='scroll'><table id='tabid' class='table table-bordered  editableTable'>
        ";
                
     $concat .= "<thead>
                    <tr>
                        <th ><h4>Date</h4></th>
                        <th >Day</th>
                        <th style='background-color:red;color:white'>Holiday</th>
                        <th style='background-color:red;color:white'>Note </th>";       
    foreach ($member as $value) {
        $concat .= "<th style='background-color:#68dff0;'>".$value['Member']['member']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>";
    }      


    
  
    $dayName = date ("D",strtotime($date));
    while (strtotime($date) <= strtotime($end_date)) {
       
        $concat .= "<tr><td>".$date."</td>
                        <td>".$dayName."</td><td></td><td></td>";

        if($dayName != 'Sun' && $dayName != 'Sat')
        {
            foreach ($member as $value)
            {
                $concat .= "<td class='cellEditing'>9am-6pm</td>";
            }
         }

        $date = date ("Y-m-d", strtotime("+1 day", strtotime($date)));
        $dayName =date ("D",strtotime($date));
    }



echo $tableHeader;



$file = WWW_ROOT.'files\shift.txt';
$table = file_get_contents($file);

if(filesize($file) == 0)
{
    echo $concat;
}
else
{
    echo '<div id="sharon">'.$table.'</div></div>';
}

    echo "</table></div>";
?>



<input type='button' class='btn btn-primary' id='update-shift' value='UPDATE'>