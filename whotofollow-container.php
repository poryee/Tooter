<div class="main-header"><h2>Who to follow?</h2></div>
<?php
$sql = "SELECT TOP 3 * FROM ( SELECT DISTINCT tooterUser.username, tooterUser.userimage, tooterUser.name FROM tooterUser WHERE tooterUser.username <> ? ) as sub  ORDER BY NEWID()";
$stmt = $connection -> prepare ($sql);
$stmt -> bindValue(1, $username);
$stmt -> execute();
while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
{
	$tooterusername = $row['username'];
	$tootername = $row['name'];
	$profileimage = $row['userimage'];
	
        echo '<div class = "who-container">';
        echo '<img src = "' . $profileimage . '" class = "toot-dp">';
        echo '<div class = "who-data">';
        echo '<span class = "who-data-profile-header">';
        echo '<a href="profile.php?user=' . $tooterusername . '"><strong class = "toot-username">';
        echo $tootername;
        echo '</strong></a>';
        echo '<span class = "toot-profilename"> @';
        echo $tooterusername;
        echo '</span><br/>';
        echo '</span>';

		$SQL = "SELECT * FROM follows WHERE username = ? AND following= ?";
		$stmt2 = $connection -> prepare ($SQL);
		$stmt2 -> bindValue(1, $username);
		$stmt2 -> bindValue(2, $tooterusername);
		$stmt2 -> execute();
		$result = $stmt2->fetchAll();
		$num_rows = count($result);
        if ($num_rows > 0) {
            echo '<form class = "follow-form" action="unfollow-user.php" method="post">';
            echo '<input type="text" name="profilename" value="' . $tooterusername . '" hidden>';
            echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Unfollow</span></button>';
            echo '</form>';
        } else {
            echo '<form class = "follow-form" action="follow-user.php" method="post">';
            echo '<input type="text" name="profilename" value="' . $tooterusername . '" hidden>';
            echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Follow</span></button>';
            echo '</form>';
        }
        echo '</div>';
        echo '</div>';
    }
?>
</div>