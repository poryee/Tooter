<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';

?>

<html>
   
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/tootercss.css" />
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        
        <title>Sign up for Tooter</title>        
        <link rel="shortcut icon" href="images/logo-icon.ico">
    </head>
    <body>
        <header class="topbar">           
            <?php include 'header.php' ?>                      
        </header>
        
        <main>
            <div id="box-content">                
                <form id="sign-form" method="post" action="signup-process.php">
                    <h2 class="sign-header">Join Tooter today.</h2><br/>
                <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST"){
                            if(empty($_POST['fullname'])){
                                $fnamevalid = false;
                                echo '<p class="form-header">Full Name</p>
                                      <input type="text" size="51%" name="fullname" placeholder="Please do not leave your First Name empty. " required><br/>';
                            }
                            else{
                                $fname = trim($_POST['fullname']);
                                $fnamevalid = true;
                                echo '<p class="form-header">Full Name</p>
                                      <input type="text" size="51%" name="fullname" value='.$fname.'><br/>';
                            }    
                            
                            if(empty($_POST['username'])){
                                $unamevalid = false;
                                echo '<p class="form-header">User Name</p>
                                      <input type="text" size="51%" name="username" placeholder="Please do not leave your User Name empty." required><br/>';
                            }
                            else{
                                $uname = trim($_POST['username']);
                                $unamevalid = true;
                                echo '<p class="form-header">User Name</p>
                                      <input type="text" size="51%" name="username" value='.$uname.'><br/>';                                
                            }
                            
                            if(empty($_POST["email"])){
                                $emailvalid = false;
                                echo '<p class="form-header">Email</p>
                                      <input type="email" size="51%" name="email" placeholder="Please do not leave your Email empty." required><br/>';
                            }
                            else{
                                $email = trim($_POST['email']);
                                $emailvalid = true;
                                echo '<p class="form-header">Email</p>
                                      <input type="email" size="51%" name="email" value='.$email.'><br/>';
                            } 
                            
                            $passwordFormat = "/^(?=.*\d)(?=.*[a-z])[0-9a-zA-Z]{8,}$/";
                            if(empty($_POST["password"]) || !preg_match($passwordFormat,$_POST["password"])){
                                $passvalid = false;
                                echo '<p class="form-header">Password</p>
                                      <input type="password" size="51%" name="password" placeholder="Please enter a Password with at least 8 alphanumeric characters." required><br/>';
                            }
                            else{
                                $pword = trim($_POST['password']);
                                $passvalid = true;
                                echo '<p class="form-header">Password</p>
                                      <input type="password" size="51%" name="password" value='.$pword.'><br/>';
                            }
                            
                           if(empty($_POST["passwordconfirm"]) || $_POST["password"] != $_POST["passwordconfirm"] ){
                                $passcvalid = false;
                                echo '<p class="form-header">Confirm Password</p>
                                      <input type="password" size="51%" name="passwordconfirm" placeholder="Please enter a matching Password as above." required><br/>';
                            }
                            else{
                                $passc= trim($_POST['passwordconfirm']);
                                $passcvalid = true;
                                echo '<p class="form-header">Password</p>
                                      <input type="password" size="51%" name="passwordconfirm" value='.$passc.'><br/>';
                            }
                            if($fnamevalid && $unamevalid && $emailvalid && $passvalid && $passcvalid){
                                $sql = "INSERT INTO login (name, username, password, email, image) VALUES (?,?,?,?,?)";
                                echo "hwhat";
								$stmt = $connection->prepare($sql);
								$stmt->bindValue(1, $fname);
								$stmt->bindValue(2, $uname);
								$stmt->bindValue(3, $pword);
								$stmt->bindValue(4, $email);
								$stmt->bindValue(5, 'DisplayImages/default-dp.jpg');
								echo "hello";
								$stmt->execute();
								echo "hello1";
                                session_start();
                                $_SESSION['logintest'] = "1";
                                header('location:signin.php');
                            }
                    } 
                ?>
                <button type="submit" id="btn-create" class="">Create my account</button>
                <br/><br/><p id="termsinfo">By signing up, you agree to the Terms of Service and Privacy Policy, including Cookie Use. Others will be able to find you by email or phone number when provided.</p>
                </form>
                <div id="sign-info">
                    <div id="sign-info-content">
                        <p>Already have an account? <a href="signin.php">Sign in here »</a></p>
                    </div>
                </div>
            </div>           
        </main>
        
    <script src="js/validation.js"></script>
    </body>
</html>