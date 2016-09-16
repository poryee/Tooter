<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

$profileName = isset($_GET['following']) ? $_GET['following'] : '';

$sql_select = "SELECT * FROM tooterUser WHERE username = '".$profileName."'";
$stmt = $connection->query($sql_select);       
$result= $stmt->fetchAll();  
$firstRow= $result[0];

$coverimage = $firstRow["coverimage"];
$image2 = $firstRow["userimage"];
$tootername = $firstRow["name"];
?>

<html id="profilehtml">
    <head>
        <link rel="stylesheet" href="css/tootercss.css" />
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="images/logo-icon.ico">
        <title>Profile</title>
    </head>
    <body>
        <header class="topbar">
            <?php
            include 'header.php';
/*            change to session variables
			$sqltest = "SELECT image, name, coverimage FROM login WHERE username = '".mysql_real_escape_string($profilename)."'";
            $result = mysqli_query($connection, $sqltest);
            $row = mysqli_fetch_assoc($result);
            $image = $row['image'];
            $coverimage = $row['coverimage'];
            $tootername = $row['name']; */
            ?>
        </header>

        <main id = "profile-container">
            <div id = "profile-cover">
                <img class="profile-coverimage" src="<?php echo $coverimage ?>">
            </div>
            <div id = "profile-dp">
                <img id = "profile-dp-img" src = "<?php echo $image2 ?>"/>
                <div id = "profile-container-data">
                    <p id = "profile-name-main"><?php echo $tootername
            ?></p>
                    <p id="profile-username-main">@<?php echo $profileName ?></p>
                </div>
            </div>
            <div id="profile-info-bar">
                <div id="profile-info-data">
				<?php
                    echo "<a href='profile.php?user=$profileName'><div class='profile-data'>"; ?>
                            <p class="profile-data-header">Toots</p>
                    <!--<a href=""><div class="profile-data">
                            <p class="profile-data-header">Toots</p>-->
                            <?php
							$sql = "SELECT count(text) FROM toot_post WHERE username = ?";
							$stmt = $connection -> prepare ($sql);
							$stmt -> bindValue(1, $profileName);
							$stmt -> execute();
							$tweetcount = $stmt->fetchColumn(); 
                                    echo '<p class="profile-data-info">';
                                    echo $tweetcount;
                                    echo '</p>';
                            ?>
                        </div></a>   
						 
                           
                    <a href=""><div class="profile-data">
                            <p class="profile-data-header">Following</p>
                            <?php
							$sql1 = "SELECT count(following) FROM follows WHERE username = ?";
							$stmt1 = $connection -> prepare ($sql1);
							$stmt1 -> bindValue(1, $profileName);
							$stmt1 -> execute();
							$followingcount = $stmt1->fetchColumn(); 
                                    echo '<p class="profile-data-info">';
                                    echo $followingcount;
                                    echo '</p>';
                            ?>
                        </div></a>    
					<?php
					echo "<a href='profileFollower.php?follower=$profileName'><div class='profile-data'>"; ?>
                            <p class="profile-data-header">Followers</p>
                   <!-- <a href=""><div class="profile-data">
                            <p class="profile-data-header">Followers</p>-->
                            <?php
							$sql2 = "SELECT count(username) FROM follows WHERE following = ?";
							$stmt2 = $connection -> prepare ($sql2);
							$stmt2 -> bindValue(1, $profileName);
							$stmt2 -> execute();
							$followercount = $stmt2->fetchColumn(); 
                                    echo '<p class="profile-data-info">';
                                    echo $followercount;
                                    echo '</p>';
                            ?>
                        </div></a>
                    <?php

					$sql3 = "SELECT * FROM follows WHERE username = ? AND following= ?";
					$stmt3 = $connection -> prepare ($sql3);
					$stmt3 -> bindValue(1, $username);
					$stmt3 -> bindValue(2, $profileName);
					$stmt3 -> execute();
					$result = $stmt3->fetchAll();
					$num_rows = count($result);

                    if ($profileName == $username) {
                        echo '<a href="profile-settings.php"><button id="profile-settings-btn">Edit Profile</button></a>';
                    } else {
                        if ($num_rows > 0) {
                            echo '<form class = "follow-form" action="unfollow-user.php" method="post">';
                            echo '<input type="text" name="profilename" value="' . $profileName . '" hidden>';
                            echo '<button id="profile-settings-btn" type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Unfollow</span></button>';
                            echo '</form>';
                        } else {
                            echo '<form class = "follow-form" action="follow-user.php" method="post">';
                            echo '<input type="text" name="profilename" value="' . $profileName . '" hidden>';
                            echo '<button id="profile-settings-btn" type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Follow</span></button>';
                            echo '</form>';
                        }
                    }
                    ?>
                </div>

            </div>
            <div id="profile-sections">
                <div class="profile-left-main"></div>
                <div class="profile-middle-main">
                    <div class="main-header"><h2>Following</h2></div>
                    <div class="col-middle-main-content">
                        <?php
						$sql = "SELECT follows.following, tooterUser.userimage, tooterUser.name FROM follows INNER JOIN tooterUser ON follows.following = tooterUser.username WHERE follows.username = ?";
					$stmt = $connection -> prepare ($sql);
					$stmt -> bindValue(1, $profileName);
					$stmt -> execute();
					while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
					{
						$tootuser = $row['following'];
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
							if($username != $tootuser){
								if ($num_rows > 0) {
									echo '<form class = "follow-form" action="unfollow-user.php" method="post">';
									echo '<input type="text" name="profilename" value="' . $tootuser. '" hidden>';
									echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Unfollow</span></button>';
									echo '</form>';
								} else {
									echo '<form class = "follow-form" action="follow-user.php" method="post">';
									echo '<input type="text" name="profilename" value="' . $tootuser. '" hidden>';
									echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Follow</span></button>';
									echo '</form>';
								}
							}
							else{
								//echo '<a href="profile-settings.php"><button id="profile-settings-btn">Edit Profile</button></a>';
							}
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
						
                        
                        //}
                        ?>
                    </div>
                </div>
                <div class="profile-right-main">
                    <div class="col-right-main-who">
                        <?php include 'whotofollow-container.php' ?>
                    <div class="col-right-main-footer">
                        <?php include 'footer.php'; ?>
                    </div>
                </div>
            </div>
        </main>


    </body>
</html>
