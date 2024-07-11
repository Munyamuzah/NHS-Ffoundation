<?php 
$serverName = "DESKTOP-G0URL73\SQLNHS"; //put your server name
$connectionOptions = array(
    "Database" => "nhs",
    "Uid" => "sa", // put your databse username
    "PWD" => "mumu123"  //put your databse password
);
//connection query
$connection = sqlsrv_connect($serverName, $connectionOptions);
if (!$connection) {
    die(print_r(sqlsrv_errors(), true));
}
?>
