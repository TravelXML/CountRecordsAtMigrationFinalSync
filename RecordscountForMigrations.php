<?php
// Sapan Mohanty
// Skype:sapan.mohannty
//***********************************
$oldData = mysql_connect('localhost', 'DBUSER', 'DBPASS');
echo mysql_error();

$NewData = mysql_connect('localhost', 'DBUSER', 'DBPASS');
echo mysql_error();

mysql_select_db('roomallo_radb', $oldData);
mysql_select_db('openhote_radb', $NewData);

$getAllTablesName    = "SELECT table_name FROM information_schema.tables WHERE table_type = 'base table'";
$getAllTablesNameExe = mysql_query($getAllTablesName);

//echo mysql_error();
while ($dataTableName = mysql_fetch_object($getAllTablesNameExe)) {
    
    $oldDataCount       = mysql_query('select count(*) as noOfRecord from ' . $dataTableName->table_name, $oldData);
    $oldDataCountResult = mysql_fetch_object($oldDataCount);
    
    
    $newDataCount       = mysql_query('select count(*) as noOfRecord from ' . $dataTableName->table_name, $NewData);
    $newDataCountResult = mysql_fetch_object($newDataCount);
    
    if ( $oldDataCountResult->noOfRecord != $newDataCountResult->noOfRecord ) {
        echo "<br/><b>" . $dataTableName->table_name . "</b>";
        echo " | Old: " . $oldDataCountResult->noOfRecord;
        echo " | New: " . $newDataCountResult->noOfRecord;
        
        if ($oldDataCountResult->noOfRecord < $newDataCountResult->noOfRecord) {
            echo " | <font color='green'>*</font>";
            
        } else {
            echo " | <font color='red'>*</font>";
        }
        
        echo "<br/>----------------------------------------";
        
    }     
    
}
?>
