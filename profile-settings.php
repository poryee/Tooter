<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

/* $imageresult = mysqli_query($connection, "SELECT image FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$imagerow = mysqli_fetch_assoc($imageresult);
$image = $imagerow['image'];

$coverimageresult = mysqli_query($connection, "SELECT coverimage FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$coverimagerow = mysqli_fetch_assoc($coverimageresult);
$coverimage = $coverimagerow['coverimage']; */
$email = $_SESSION['email'];
?>

<html>
    <head>
        <meta charset="UTF-8">        
        <link rel="stylesheet" href="css/tootercss.css" />
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        <title>Tooter</title>        
        <link rel="shortcut icon" href="images/logo-icon.ico">
    </head>
    <body>
        <header class="topbar">
            <?php include 'header.php' ?>   
        </header>

        <div id="main-bgi">
        </div>

        <main class="main-main">
            <?php include 'profile-container.php'; ?>

            <div class="col-middle-main">
                <div class="main-header"><h2>Profile Settings</h2></div>
                <p class="subheader">Change your basic account settings.</p>
                <hr>
                <div class="col-middle-main-content">
                    <div id="settings-form-container">
                        <form enctype="multipart/form-data" method="post" action="profileupdate-process.php">
                            <div class="settings-form-label-container">
                                <div class="label-container">Username</div>
                                <input class="settings-input" type="text" name="username" value="<?php echo $username; ?>"><br/>
                            </div>
                            <div class="settings-label-container">
                                <div class="label-container">Email</div>
                                <input class="settings-input" type="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <div class="settings-label-container">
                                <div class="label-container">Profile Picture</div>
                                <input class="settings-input" type="file" name="image">
                            </div>
                            <div class="settings-label-container">
                                <div class="label-container">Cover Picture</div>
                                <input class="settings-input" type="file" name="coverimage">
                            </div>
                            <button type="submit" id="btn-update" class="">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-right-main">
                <!--<div class="col-right-main-trending">
                    <div class="main-header"><h2>Who to follow?</h2></div>
                </div>-->
				<div class="col-right-main-who">
                    <?php include 'whotofollow-container.php' ?>
				
                <div class="col-right-main-footer">
                    <?php include 'footer.php' ?>
                </div>
            </div>
        </main>

        <script src="js/jquery.min.js"></script>
        <script src="js/tooterjs.js"></script>
    </body>
</html>