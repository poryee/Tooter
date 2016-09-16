<?php
$sql = "SELECT DISTINCT toot_post.text, toot_post.pid, toot_post.username, tooterUser.name, toot_post.image, toot_post.time, tooterUser.userimage FROM toot_post LEFT JOIN follows ON toot_post.username=follows.following INNER JOIN tooterUser on tooterUser.username=toot_post.username WHERE follows.username = ? OR tooterUser.username = ? ORDER BY pid DESC";
$stmt = $connection -> prepare ($sql);
$stmt -> bindValue(1, $username);
$stmt -> bindValue(2, $username);
$stmt -> execute();
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
{
	$tweet = $row['text'];
	$tweetid = $row['pid'];
	$tootuser = $row['username'];
	$tootname = $row['name'];
	$tootimage = $row['image'];
	$toottime = $row['time'];
	$profileimage = $row['userimage'];
	
        echo '<div class="toot-container">';
        echo '<span class="toot-time">'.$toottime.'</span>';
        echo '<div class="toot-content">';
        echo '<img src="' . $profileimage . '" class="toot-dp">';
        echo '<div class="toot-content-data">';
        echo '<strong class="toot-username"><a href="profile.php?user=' . $tootuser . '">';
        echo $tootname;
        echo '</a></strong><span class="toot-profilename"> ';
        echo '@' . $tootuser;
        echo '</span>';
        echo '<strong hidden class="toot-hiddenuser"><a href="profile.php?user=' . $tootuser . '">';
        echo $tootuser;
        echo '</a></strong><p class="toot">';
        echo $tweet;
        echo '</p>';
        if ($tootimage != '') {
            echo '<div style="margin-top:4%; margin-bottom:4%;">';
            echo '<a href="#" class="trigger"><img  style="display: block; width:auto; max-width:480px; max-height:300px; " src="';
            echo $tootimage;
            echo '"></a>';
            echo '</div>';
        }
        echo '<div class="toot-buttons">';
        echo '<a href="#" class="toot-buttons-reply"><span title="Reply" class="glyphicon glyphicon-bullhorn"></span></a>';
        echo '<a href="#" class="toot-buttons-rt"><span title="Retoot" class="glyphicon glyphicon-retweet"></span></a>';
        if ($tootuser == $username) {
            echo '<a href="delete.php?idd=' . $tweetid . '"><span class="glyphicon glyphicon-remove"></span></a>';
        }
        echo '</div></div></div></div>';
}



