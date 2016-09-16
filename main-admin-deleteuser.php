<?php
$previousPage = basename($_SERVER['HTTP_REFERER']); 
include 'connectDB.php';
include 'checkSession.php';
   
//$username = isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : '';
$profilename = isset($_POST['profilename']) ? $_POST['profilename']: '';
echo $username;
echo $profilename;
//$sql = "INSERT INTO follow (follower,user) VALUES ('".mysql_real_escape_string($username)."','".mysql_real_escape_string($_POST['profilename'])."')";
$sql3 = "DELETE FROM tooterUser where username = (?)";
$stmt3 = $connection->prepare($sql3);
$stmt3->bindValue(1, $profilename);
$stmt3->execute();

//echo $sql;
//if (isset($_POST['profilename'])){
//      $insert = mysqli_query($connection,$sql);      
//}

header("location:".$previousPage."");

?>