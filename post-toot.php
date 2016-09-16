<?php

date_default_timezone_set('Asia/Singapore');
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

$username = isset($_SESSION['userlogin']) ? $_SESSION['userlogin'] : '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $check=0;
    $uname = $username;
    $time = date('M d, g:ia');
    $text = $_POST['toot-text'];
    $file = $_FILES['image']['tmp_name'];
    $imagesizedata = $_FILES['image']['size'];
    $maxsize = 2097152;
    $image_type = $_FILES['image']['type'];
    $allowedImages = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    if (file_exists($file)) {
        if ($imagesizedata === FALSE) {
            header('location:main.php');
            die();
        } else if ($imagesizedata >= $maxsize) {
            header('location:main.php');
            die();
        } else if (in_array($image_type, $allowedImages) === false) {
            header('location:main.php');
            die();
        }
    }
    $image_temp = $_FILES['image']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $upload = move_uploaded_file($image_temp, "UploadedImages/" . $image_name);
    if (empty($file)) {
        $image_link = "";
    } else {
        $image_link = "UploadedImages/" . $image_name;
    }
	echo $uname,$text,$image_link,$time;
    
        
        
        //if got hashtag
        if (preg_match("/(#\w+)/", $text, $matches)) {
            $check= $matches[0];
        
        //echo $check;    
            
        $sql_insert0 = "Select * FROM hashtag where hashword = (?)";
	$stmt0 = $connection -> prepare($sql_insert0);
	
	$stmt0->bindValue(1, $check);
	
	$stmt0->execute();
        
        $row = $stmt0 -> fetch();
        
        //echo $row;
		echo "ffsdf";
        echo $row[0];
        
        if ($row[0]==""||$row[0]==NULL){
            echo "im in";
            $sql_insert2 = "INSERT INTO hashtag (hashword) VALUES (?)";
            $stmt3 = $connection -> prepare($sql_insert2);

            $stmt3->bindValue(1, $check);

            $stmt3->execute();
        }else{
            echo "sdasdasd";
        } 
    }else {
		$check = null ;
	}
	
	if ($check != null){
		$withouthash=  str_replace("#", "", $check);
		$text = str_replace("$check", "<a href='hashsearch.php?hashword=$withouthash'>$check</a>", "$text");
		echo "check ".$check;
	}
    
	
    $sql_insert = "INSERT INTO toot_post (username,text,image,time,hashword) VALUES (?,?,?,?,?)";
	$stmt2 = $connection -> prepare($sql_insert);
	echo "hello";
	$stmt2->bindValue(1, $uname);
	$stmt2->bindValue(2, $text);
	$stmt2->bindValue(3, $image_link);
	$stmt2->bindValue(4, $time);
    $stmt2->bindValue(5, $check);
	
	echo "hello1";
	$stmt2->execute();
	echo "hello12";
       
        
}
header('location:main.php');
?>