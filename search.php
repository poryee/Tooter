<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); 
include 'connectDB.php';
include 'checkSession.php';

$searchWord = $_GET['search'];
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
                <?php include 'profile-container.php' ?>   
        </div>

        <div class="col-middle-main">
            <div class="main-header"><h2>Search Results for: "<?php if($searchWord == ''){echo '<b>nothing</b>!';}else{echo "<b>".$searchWord."</b>";} ?>"</h2></div>
            <hr>
            <div class="col-middle-main-content">
                <?php
		
                if ($searchWord == '') {
		?>
                <hr>
                <p style="margin-left:10px;">No results. Please enter something to search for! </p>
                
                <?php
                    //echo "No results.";
					
                }
		else
		{
                    ?>
                <div class="main-header"><h2>Users</h2></div>
                    <?php
                    $sql = "SELECT * FROM tooterUser WHERE name LIKE '".$searchWord."'";
					$stmt = $connection -> prepare ($sql);
					$stmt -> execute();
                                        if ($stmt -> fetch(PDO::FETCH_ASSOC) == NULL){
                                            echo '<div style="height: 80px;" class="toot-container"><div class="toot-content">No users found!</div></div>';
                                        }
                                        else
                                        {
					while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
					{
						$tootuser = $row['username'];
						$tootname = $row['name'];
						$profileimage = $row['userimage'];
                            echo '<div style="height: 80px;" class="toot-container">';
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
									echo '<input type="text" name="profilename" value="' . $tootuser . '" hidden>';
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
                            echo '</div></div></div>';
                                        }
			}
                    ?>
                <div class="main-header"><h2>Toots</h2></div>
                        <?php
				$sql = "SELECT toot_post.text, toot_post.username, toot_post.image FROM toot_post WHERE toot_post.text LIKE ?";
				$stmt = $connection -> prepare ($sql);
				$stmt -> bindValue(1, '%'.$search.'%');
				$stmt -> execute();
                                if ($stmt -> fetch(PDO::FETCH_ASSOC) == NULL){
                                            echo '<div style="height: 80px;" class="toot-container"><div class="toot-content">No toots found!</div></div>';
                                        }
                                        else
                                        {
				while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
				{
					$tweet = $row['text'];
					$tootername = $row['username'];
					$tootimage = $row['image'];
                
                            echo '<div class="toot-container">';
                            echo '<div class="toot-content">';
                            echo '<img src="css/bgImages/bg1.jpg" class="toot-dp">';
                            echo '<div class="toot-content-data">';
                            echo '<strong class="toot-username">';
                            echo $tootername;
                            echo '</strong ><a href="profile.php?user='.$row['username'].'"> <span class="toot-profilename">';
                            echo '@' . $tootername;
                            echo '</span>';
                            echo '</a>';
                            echo '<p class="toot">';
                            echo $tweet;
                            echo '</p>';
							if($tootimage != ''){
								echo '<a href="#" "><img style="height:auto; width:500px; " src="';
								echo $tootimage;
								echo '"></a>';
								}
                            echo '</div></div></div>';
                    }
		}
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
