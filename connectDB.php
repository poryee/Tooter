<?php

//include 'config.php';

$errorMessage = "";
$num_rows = 0;

$host = "tooterserver.database.windows.net";
$user = "tooteradmin";
$pwd = "Tt123456";
$db = "tooterdb";

// Connecting to database
try {
    $connection = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $connection ->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}

