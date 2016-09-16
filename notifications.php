<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';

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
                <div class="main-header"><h2>Notifications</h2></div>
                <div class="col-middle-main-content">
                    <?php
                    $sql = "SELECT tp.text, tp.username, tooterUser.username as tuuser, tp.image, tp.time, tooterUser.userimage FROM toot_post tp INNER JOIN tooterUser ON tp.username = tooterUser.username WHERE tp.text LIKE '%".$username."%'";
					$stmt = $connection -> prepare($sql);
					
					$stmt -> execute();
					
					while ($row = $stmt -> fetch(PDO::FETCH_ASSOC)){
						
						$tootername = $row['username'];						
						$tootuser = $row['tuuser'];						
						$profileimage = $row['userimage'];
						$toottime = $row['time'];
						$tweet = $row['text'];
						$tootimage = $row['image'];
                            echo '<div class="toot-container">';
                            echo '<span class="toot-time">'.$toottime.'</span>';
                            echo '<div class="toot-content">';
                            echo '<img src="'.$profileimage.'" alt="" class="toot-dp">';
                            echo '<div class="toot-content-data">';
                            echo '<strong class="toot-username"><a href="profile.php?user='.$tootername.'">';
                            echo $tootuser;
                            echo '</a></strong> <span class="toot-profilename">';
                            echo '@' . $tootername;
                            echo '</span>';
                            echo '<p class="toot">';
                            echo $tweet;
                            echo '</p>';
							
								echo '<div style="margin-top:4%; margin-bottom:4%;">';
								echo '<a href="#" class="trigger"><img style="display: block; width:auto; max-width:480px; max-height:300px; " src="';
								echo $tootimage;
								echo '"></a>';
								echo '</div>';
							
                            echo '</div></div></div>';						
					}
                    ?>
                </div>
            </div>

            <div class="col-right-main">
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
