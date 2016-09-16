<?php
include 'connectDB.php';




if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $uname = $_POST['username'];
    $pword = $_POST['password'];

    $uname = htmlspecialchars($uname);
    $pword = htmlspecialchars($pword);

    /*
	$sql_select = 'SELECT * FROM login WHERE username = "'.$uname.'" AND password = "'.$pword.'"';
	
	$stmt = $connection->query($sql_select);
	$login = $stmt->fetchAll(); 
	if(count($login) >0){
        session_start();
        $_SESSION['login'] = "1";
        $_SESSION['userlogin'] = $uname;
        
        $sql1 = 'select name from login where username = "'.$uname.'" limit 1';
        $stmt1 = $connection->query($sql_select);
		$login1 = $stmt->fetchAll(); 
        $_SESSION['fname'] = $login1['name'];
        
        header("location: main.php");*/
        
        $sql_select = "SELECT * FROM tooterUser WHERE username = '".$uname."' AND userpassword = '".$pword."'";
        $stmt = $connection->query($sql_select);       
        $result= $stmt->fetchAll();  
        $firstRow= $result[0];
        
    
    if($firstRow[username]==$uname){
        $sql2 = "SELECT * FROM admin where username = '".$uname."'";
        $stmt2 = $connection->query($sql2);       
        $result2 = $stmt2->fetchAll();  
        $firstRow2 = $result2[0];
	echo "asdsad";
        if($firstRow2[username]==$uname){
	    session_start(); 
            $_SESSION['login'] = "1";
	    $_SESSION['admin'] = "1";
            header("location: main-admin.php");
        }
        else
        {
            session_start();       
            $_SESSION['login'] = "1";
            $_SESSION['userlogin'] = $uname;
		//echo $firstRow[image];
                $_SESSION['image'] = $firstRow[userimage];
		$_SESSION['coverimage'] = $firstRow[coverimage];
		$_SESSION['email'] = $firstRow[email];
		$_SESSION['name'] = $firstRow[name];

        //echo "success";
        header("location: main.php");
        }
        
    }
        
        
    else{
        session_start();
        $_SESSION['login'] = "";
        $_SESSION['error'] = "1";
        //echo"woo";
        header("location: signin.php");
    }

}