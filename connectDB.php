<?php

//include 'config.php';

$errorMessage = "";
$num_rows = 0;

//$host = "tooterserver.database.windows.net";
//$user = "tooteradmin";
//$pwd = "Tt123456";
//$db = "tooterdb";

$servername = "localhost";
$username = "tooteradmin";
$password = "Tt123456";
$dbname = "tooterdb";

/*
Server: tooterserver.database.windows.net,1433 \r\n
SQL Database: tooterdb
User Name: tooteradmin\r\n\r\n
PHP Data Objects(PDO) Sample Code:\r\n\r\ntry {\r\n   
*/

try{
    $connection = new PDO ("sqlsrv:server = tcp:tooterserver.database.windows.net,1433; Database = tooterdb", tooteradmin, Tt123456);
    $connection->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch ( PDOException $e ) 
{
    print("Error connecting to SQL Server.");
    die(print_r($e));
}
 
/**        
$connectionInfo = array(UID => tooteradmin@tooterserver, pwd => Tt123456, Database => tooterdb, LoginTimeout => 30, Encrypt => 1, TrustServerCertificate => 0);
$serverName = tcp:tooterserver.database.windows.net,1433;
$conn = sqlsrv_connect($serverName, $connectionInfo);

// Connecting to database
try {
    $connection = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $connection ->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}

*/
?>
