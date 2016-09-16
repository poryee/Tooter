<?php 
/* $coverimageresult = mysqli_query($connection, "SELECT coverimage FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$coverimagerow = mysqli_fetch_assoc($coverimageresult);
$coverimage = $coverimagerow['coverimage']; */
//session_start();  
$image = $_SESSION['image'];
$coverimage = $_SESSION['coverimage'];
$name = $_SESSION['name'];
?>

<div class="col-left-main">
    <div class="col-left-main-profile">
        <div class="profile-cover">            
            <img class="profile-coverimage" src=<?php echo $coverimage ?>>
            <img class="profile-dp" src=<?php echo $image ?>>
        </div>
        <div class="profile-info">
            <div class="profile-info-header">
                <a href="profile.php?user=<?php echo $username ?>" id="profile-name"><?php echo $name ?></a><br/>
                <a href="profile.php?user=<?php echo $username ?>" id="profile-username">@<?php echo $username ?></a>
            </div>
            <div class="profile-info-info">
                <a href="toot.php"><div class="profile-data">
                        <p class="profile-data-header">Toots</p>
                        <?php
                        $sql = "SELECT count(text) FROM toot_post WHERE username = ?";
						$stmt = $connection -> prepare ($sql);
						$stmt -> bindValue(1, $username);
						$stmt -> execute();
						$tweetcount = $stmt->fetchColumn(); 
                                /* echo '<div class="notif-list">';
                                  echo $tweet;
                                  echo '</div>'; */
                                echo '<p class="profile-data-info">';
                                echo $tweetcount;
                                echo '</p>';
                        ?>
                    </div></a>

                <a href="following.php"><div class="profile-data">
                        <p class="profile-data-header">Following</p>
                        <?php
						$sql1 = "SELECT count(following) FROM follows WHERE username = ?";
						$stmt1 = $connection -> prepare ($sql1);
						$stmt1 -> bindValue(1, $username);
						$stmt1 -> execute();
						$followingcount = $stmt1->fetchColumn(); 
                                /* echo '<div class="notif-list">';
                                  echo $tweet;
                                  echo '</div>'; */
                                echo '<p class="profile-data-info">';
                                echo $followingcount;
                                echo '</p>';
                        ?>
                    </div></a>

                <a href="follower.php"><div class="profile-data">
                        <p class="profile-data-header">Followers</p>
                        <?php
						$sql2 = "SELECT count(username) FROM follows WHERE following = ?";
						$stmt2 = $connection -> prepare ($sql2);
						$stmt2 -> bindValue(1, $username);
						$stmt2 -> execute();
						$followercount = $stmt2->fetchColumn(); 
                                /* echo '<div class="notif-list">';
                                  echo $tweet;
                                  echo '</div>'; */
                                echo '<p class="profile-data-info">';
                                echo $followercount;
                                echo '</p>';
                        ?>
                    </div></a>
            </div>
        </div>
    </div>
</div>
