
<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
//include 'connectDB.php';
//include 'checkSession.php';
?>

<html>
    <head>
        <meta charset="UTF-8">        
        <link rel="stylesheet" href="css/tootercss.css" />
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        
        <title>Welcome to Tooter - Login</title>        
        <link rel="shortcut icon" href="images/logo-icon.ico">
    </head>
    <body>
        <header class="topbar">           
            <?php include 'header.php' ?>                      
        </header>
        
        <div id="index-bgi">
        </div>
        
        <main>
            <div id="index-content">
                <div id="leftCol">
                    <h1>Welcome to Tooter.</h1><br/>
                    <p>
                        Connect with your pals — and other fascinating people. Get updates on the things that interest you.
                        and watch events unfold, in real time, from every angle.
                    </p>                
                </div>
                <div id="rightCol-Sign-In">
                    <form id="signin-form" method="post" action="signin-process.php">
                        <input type="text" name="username" id="input-username" class="" size="31%" placeholder="Username"/>
                        <input type="password" name="password" id="input-password" class="" size="21%" placeholder="Password"/>
                        <button type="submit" id="btn-signin" class="">Sign in</button><br/>
<!--                        <input type="checkbox" id="input-privacy">Remember me-->
                    </form>
                </div>
                <div id="rightCol-Register">
                    New to Tooter? Sign up<hr>
                    <form id="signup-form" method="post" action="signup-process.php">
                        <input type="text" name="fullname" class="" size="31%" placeholder="Full name"/>
                        <input type="text" name="username" class="" size="31%" placeholder="Username"/>
                        <input type="email" name="email" class="" size="31%" placeholder="Email"/>
                        <input type="password" name="password" class="" size="31%" placeholder="Password"/><br/>
                        <button type="submit" id="btn-signup">Sign up for Tooter</button>
                    </form>
                </div>
                <div id="home-main-caption">
                    <p id="caption">Checkout my ride that I've just gotten! #car</p><br/>
                    <u><a href=""><p id="caption-author">Toot and caption by tom</p></a>
                    <u><a href=""><p id="caption-time">3:13 PM - 10 Jul 2014</p></a>
                </div>
            </div>
        </main>
        
        <footer>
            <?php include 'footer.php' ?>
        </footer>
        
        <script src="js/jquery.min.js"></script>
        <script src="js/tooterjs.js"></script>
    </body>
</html>
