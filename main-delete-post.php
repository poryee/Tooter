<?php

$previousPage = basename($_SERVER['HTTP_REFERER']);
include 'connectDB.php';
include 'checkSession.php';
   
//$username = isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : '';
$id= trim($_GET['id']); 


$sql3 = "DELETE FROM toot_post where pid= (?)";
$stmt3 = $connection->prepare($sql3);
$stmt3->bindValue(1, $id);
$stmt3->execute();

//echo $sql;
//if (isset($_POST['profilename'])){
//      $insert = mysqli_query($connection,$sql);      
//}

header("location:".$previousPage."");
	
?>
