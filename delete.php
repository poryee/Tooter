<?php


$previousPage = basename($_SERVER['HTTP_REFERER']);
include 'connectDB.php';

$id = $_GET['idd'];
$converted = intval($id);
//$delete="DELETE FROM toot WHERE pid='".intval($id)."'";
//$sql= mysqli_query($connection,$delete);

$delete="DELETE FROM toot_post WHERE pid=".$converted;      

$stmt = $connection->prepare($delete);
$stmt->execute();
header('location:'.$previousPage);

?>