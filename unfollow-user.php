<?php
$previousPage = basename($_SERVER['HTTP_REFERER']); 
include 'connectDB.php';
include 'checkSession.php';
   
$username = isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : '';
$profilename = isset($_POST['profilename']) ? $_POST['profilename']: '';

//$sql = "DELETE FROM follow WHERE follower ='".mysql_real_escape_string($username)."' AND user='".mysql_real_escape_string($_POST['profilename'])."'";
$sql = "DELETE FROM follows WHERE username = ? AND following= ?";
$stmt = $connection->prepare($sql);
$stmt->bindValue(1, $username);
$stmt->bindValue(2, $profilename);
$stmt->execute();
//if (isset($_POST['profilename'])){
//      $insert = mysqli_query($connection,$sql);      
//}

header("location:".$previousPage."");
?>