<?php
$link = mssql_connect("SGDW-DEV\sgdwdev:1433","portal_user","biportal");
//mssql_select_db('safeguard') or die("Unable to select database");
if (!$link) { die('Something went wrong while connecting to MSSQL'); }

$query = 'SELECT TOP 1000 [UserID],[UserName] FROM [safeguard].[dbo].[User]';
$result=mssql_query($query,$link);
$result1=mssql_fetch_array($result);
print_r($result1);

?>
 