<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';

/* $coverimageresult = mysqli_query($connection, "SELECT coverimage FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$coverimagerow = mysqli_fetch_assoc($coverimageresult);
$coverimage = $coverimagerow['coverimage']; */
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
                <div class="main-header"><h2>Followers</h2></div>
                <div class="col-middle-main-content">
                    <?php
                    $sql = "SELECT follows.username, tooterUser.userimage, tooterUser.name FROM follows INNER JOIN tooterUser ON follows.username = tooterUser.username WHERE follows.following = ?";
					$stmt = $connection -> prepare ($sql);
					$stmt -> bindValue(1, $username);
					$stmt -> execute();
					while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
					{
						$tootuser = $row['username'];
						$tootname = $row['name'];
						$profileimage = $row['userimage'];
                            echo '<div class="toot-container">';
                            echo '<div class="toot-content">';
                            echo '<img src="' . $profileimage . '" class="toot-dp">';
                            echo '<div class = "who-data">';
                            echo '<span class = "who-data-profile-header">';
                            echo '<a href="profile.php?user=' . $tootuser . '"><strong class = "toot-username">';
                            echo $tootname;
                            echo '</strong></a>';
                            echo '<span class = "toot-profilename"> @';
                            echo $tootuser;
                            echo '</span><br/>';
                            echo '</span>';
                            $SQL = "SELECT * FROM follows WHERE username = ? AND following= ?";
							$stmt1 = $connection -> prepare ($SQL);
							$stmt1 -> bindValue(1, $username);
							$stmt1 -> bindValue(2, $tootuser);
							$stmt1 -> execute();
							$result = $stmt1->fetchAll();
							$num_rows = count($result);
							if ($num_rows > 0) {
                                echo '<form class = "follow-form" action="unfollow-user.php" method="post">';
                                echo '<input type="text" name="profilename" value="' . $tootuser . '" hidden>';
                                echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Unfollow</span></button>';
                                echo '</form>';
                            } else {
                                echo '<form class = "follow-form" action="follow-user.php" method="post">';
                                echo '<input type="text" name="profilename" value="' . $tootuser. '" hidden>';
                                echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Follow</span></button>';
                                echo '</form>';
                            }
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    ?>
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
    </body>
</html>