
<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';
echo $username;
$coverimageresult = mysqli_query($connection, "SELECT coverimage FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$coverimagerow = mysqli_fetch_assoc($coverimageresult);
$coverimage = $coverimagerow['coverimage'];
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
                <div class="main-header"><h2>Toots</h2></div>
                <div class="col-middle-main-content">
                    <?php
						$sql = "SELECT toot_post.pid, toot_post.text, toot_post.username, toot_post.image, toot_post.time, tooterUser.userimage, tooterUser.name FROM toot_post INNER JOIN tooterUser ON toot_post.username=tooterUser.username WHERE tooterUser.username = ? ORDER BY pid DESC";
						$stmt = $connection -> prepare ($sql);
						$stmt -> bindValue(1, $username);
						$stmt -> execute();
						while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
						{
							$tweetid = $row['pid'];
							$tweet = $row['text'];
							$tootuser = $row['username'];
							$tootimage = $row['image'];
							$toottime = $row['time'];
							$profileimage = $row['userimage'];
							$tootername = $row['name'];
                       
                                echo '<div class="toot-container">';
                                echo '<div class="toot-content">';
                                echo '<img src="' . $profileimage . '" class="toot-dp">';
                                echo '<div class="toot-content-data">';
                                echo '<strong class="toot-username"><a href="profile.php?user=' . $username . '">';
                                echo $tootername;
                                echo '</a></strong><span class="toot-profilename"> ';
                                echo '@' . $tootuser;
                                echo '</span>';
                                echo '<span class="toot-time">'.$toottime.'</span>';
                                echo '<p class="toot">';
                                echo $tweet;
                                echo '</p>';
                                if ($tootimage != '') {
                                    echo '<div style="margin-top:4%; margin-bottom:4%;">';
                                    echo '<a href="#" class="trigger"><img  style="display: block; margin-left: auto; margin-right: auto; width:auto; max-width:480px; max-height:300px; " src="';
                                    echo $tootimage;
                                    echo '"></a>';
                                    echo '</div>';
                                }
                                echo '<div class="toot-buttons">';
                                if ($tootername == $username) {
                                    echo '<a href="delete.php?idd=' . $tweetid . '"><span class="glyphicon glyphicon-remove"></span></a>';
                                }
                                echo '</div></div></div></div>';
                            }
                       // }
                        ?>
                </div>
            </div>

            <div class="col-right-main">
         <!--       <div class="col-right-main-trending">
                    <div class="main-header"><h2>Who to follow?</h2></div>
                </div> -->
				<div class="col-right-main-who">
                    <?php include 'whotofollow-container.php' ?>
				</div>
                <div class="col-right-main-footer">
                    <?php include 'footer.php' ?>
                </div>
            </div>
        </main>

        <script src="js/jquery.min.js"></script>
        <script src="js/tooterjs.js"></script>
    </body>
</html>