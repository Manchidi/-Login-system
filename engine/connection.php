<?php
$serverName = "replace with you server name";   
$uid = "sa";     
$pwd = "replace with your password";    
$databaseName = "replace with your database name";   

$connectionInfo = array( "UID"=>$uid,                              
                         "PWD"=>$pwd,                              
                         "Database"=>$databaseName);   

/* Connect using SQL Server Authentication. */    
$conn = sqlsrv_connect( $serverName, $connectionInfo); 
?>
