
<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/tootercss.css"/>
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        
        <title>Login to Tooter</title>        
        <link rel="shortcut icon" href="images/logo-icon.ico">
    </head>
    <body>
        <header class="topbar">           
            <?php include 'header.php' ?>                      
        </header>
        
        <main>
            <div id="box-content">                
                <form id="sign-form" method="post" action="signin-process.php">
                    <h2 class="sign-header">Sign in to Tooter</h2><br/>
                    <?php 
                    if ($_SESSION['error'] == "1"){
                        echo '<p style="color: red;">Incorrect username or password, please try again.</p>';
                    }
                    if ($_SESSION['logintest'] == "1"){
                        echo '<p style="color:#292f33;">Signed up successfully, please login.</p>';
                    }?>
                    <input type="text" name="username" id="input-username" class="" size="31%" placeholder="Username"/><br/>
                    <input type="password" name="password" id="input-password" class="" size="31%" placeholder="Password"/><br/><br/>
                    <button type="submit" id="btn-signin" class="">Sign in</button>
<!--                    <input type="checkbox" id="input-privacy">Remember me-->
                </form>
                <div id="sign-info">
                    <div id="sign-info-content">
                        <p>New to Tooter? <a href="signup.php">Sign up now »</a></p>
                    </div>
                </div>
            </div>
        </main>
        
        
    </body>
</html>
