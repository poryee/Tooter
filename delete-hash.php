<?php
$previousPage = basename($_SERVER['HTTP_REFERER']); 
include 'connectDB.php';
include 'checkSession.php';
   
//$username = isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : '';
$hashword = isset($_POST['hashword']) ? $_POST['hashword']: '';
echo $hashword;

//$sql = "INSERT INTO follow (follower,user) VALUES ('".mysql_real_escape_string($username)."','".mysql_real_escape_string($_POST['profilename'])."')";
 $sql3 = "DELETE FROM toot_post where hashword = (?)";
$stmt3 = $connection->prepare($sql3);
$stmt3->bindValue(1, $hashword);
$stmt3->execute(); 

$sql4 = "DELETE FROM hashtag where hashword = (?)";
$stmt4 = $connection->prepare($sql4);
$stmt4->bindValue(1, $hashword);
$stmt4->execute(); 

//echo $sql;
//if (isset($_POST['profilename'])){
//      $insert = mysqli_query($connection,$sql);      
//}

header("location:".$previousPage."");

?>