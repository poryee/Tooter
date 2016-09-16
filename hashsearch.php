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
                <?php include 'profile-container.php' ?>   
        </div>

        <div class="col-middle-main">
            <div class="main-header"><h2>Hashtag</h2></div>
            <div class="col-middle-main-content">
                <?php
                $hashword=$_GET["hashword"];
                
                if ($hashword == '') {
                    echo "No results.";
                }else{
                    $hashword="#".$hashword;
                }
                //$sql = "SELECT toot_post.text, toot_post.username, toot_post.image FROM toot_post WHERE toot_post.text LIKE '%".mysql_real_escape_string($search)."%'";
				$sql = "SELECT toot_post.text, toot_post.username, toot_post.image FROM toot_post WHERE toot_post.hashword = ?";
				$stmt = $connection -> prepare ($sql);
				$stmt -> bindValue(1, $hashword);
				$stmt -> execute();
				while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
				{
					$tweet = $row['text'];
					$tootername = $row['username'];
					$tootimage = $row['image'];
                //if ($statement = mysqli_prepare($connection, $sql)) {
                  //  mysqli_stmt_execute($statement);

                    //mysqli_stmt_bind_result($statement, $tweet, $tootername, $tootimage);
                    //while (mysqli_stmt_fetch($statement)) {
                            /* echo '<div class="notif-list">';
                              echo $tweet;
                              echo '</div>'; */
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
                            echo '<div class="toot-buttons">';
                            echo '<a href="#" ><span title="Reply" class="glyphicon glyphicon-bullhorn"></span></a>';
                            echo '<a href="#" class="toot-buttons-rt"><span title="Retoot" class="glyphicon glyphicon-retweet"></span></a>';
                            echo '</div></div></div></div>';
                    }
                //}
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
