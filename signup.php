<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';
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
                    <p class="form-header">Full Name</p>
                    <input type="text" size="51%" name="fullname" required><br/>
                    <p class="form-header">User Name</p>
                    <input type="text" size="51%" name="username" required><br/>
                    <p class="form-header">Email Address</p>
                    <input type="email" size="51%" name="email" required><br/>
                    <p class="form-header">Password</p>
                    <input type="password" size="51%" name="password" required><br/>
                    <p class="form-header">Confirm Password</p>
                    <input type="password" size="51%" name="passwordconfirm" required><br/><br/>
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
        
        
    </body>
</html>
