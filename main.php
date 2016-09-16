
<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

/* $imageresult= mysqli_query($connection, "SELECT image FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$imagerow=mysqli_fetch_assoc($imageresult);
$image=$imagerow['image']; */


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
            <?php include 'header.php'; ?>   
        </header>

        <div id="main-bgi">
        </div>

        <main class="main-main">
            <?php include 'profile-container.php'; ?> 

            <div class="col-middle-main">
                <div class="main-header"><h2>Toots</h2></div>
                <div class="col-middle-main-content">
                    <div class="post-toot">
                        <form enctype="multipart/form-data" action="post-toot.php" method="post">
                            <div class="post-toot-content">
                                <div id="toot-text" style="overflow: auto;" placeholder="What's on your mind?" contenteditable="true" spellcheck="false" class="post-toot-text"></div>
                                <textarea name="toot-text" id="toot-textarea" hidden></textarea>
                                <div id="toot-search-display"></div>
                            </div>
                            <div class="post-toot-buttons">
                                <button id="post-toot-image-btn">
                                    <span class="glyphicon glyphicon-camera"></span>
                                </button>
                                <input id="post-toot-image-btn-hidden" type="file" accept="image/png, image/jpeg, image/gif" name="image" name="image" id="image">                                
                                <span id="toot-img-preview"><img id="toot-img-preview1" src=""><span id="toot-img-preview-info"></span></span>
                                <button type="submit" id="post-toot-btn" disabled>
                                    <span class="glyphicon glyphicon-leaf"></span>Toot
                                </button>                                
                                <span id="post-toot-wordcount">255</span>
                            </div>
                        </form>
                    </div>

                    <?php include 'main-display-toot.php'; ?>            

                </div>
            </div>

            <div class="col-right-main">
                <div class="col-right-main-who">
                    <?php include 'whotofollow-container.php' ?>
                <div class="col-right-main-footer">
                    <?php include 'footer.php'; ?>
                </div>
            </div>
        </main>

        <script src="js/jquery.min.js"></script>
        <script src="js/tooterjs.js"></script>
        <script src="js/filereader.js"></script>
    </body>
</html>
