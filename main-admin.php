
<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

?>

<html>
    <head>
        <meta charset="UTF-8">        
        <link rel="stylesheet" href="css/tootercss.css" />
        <link rel="stylesheet" href="css/tblcss.css" />
        <link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet" >
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/styles.css" rel="stylesheet" type="text/css">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<script type="text/javascript" src="//code.jquery.com/jquery-2.0.2.js"></script>
		<script type="text/javascript" src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
        <title>Tooter Admin</title>        
        <link rel="shortcut icon" href="images/logo-icon.ico">
    </head>
    <body>
        <header class="topbar">
            <?php include 'header.php'; ?>   
        </header>
        
        <div id="main-bgi">
        </div>
        
        <main class="main-main">
            <div class="col-left-main">
                <div style="margin-left:20px" class="main-header"><h4>Menu</h4></div><hr style="margin: 10px 0px 10px 0px">
<!--                <ul class="contact-list">
                    <li><a href="main-admin.php?tab=1">View All Account</a></li>
                    <li><a href="main-admin.php?tab=2">View All Toot</a></li>
                </ul>-->
                    <ul style="margin: 0px 10px 0px 10px;" class="nav nav-tabs nav-stacked">
                                  
                        <li class="active">
                            <a data-toggle="tab" href="#user">
                                
                                View Accounts
                            </a>
                        </li>
                        <li class="">
                            <a data-toggle="tab" href="#toot">
                                View Toots
                            </a>
                        </li>
                        
                        <li class="">
                            <a data-toggle="tab" href="#hashtag">
                                View #HashTags
                            </a>
                        </li>
                    </ul>

            </div>
            
            <div class="col-middle-main">
                <div class="panel-body">
                              <div class="tab-content">
                                 
                                  <!-- profile -->
                                  <div id="user" class="tab-pane active">
                        
                        <div class="main-header"><h2>User</h2></div>
                        <?php
                
                
		   


				$sql = "SELECT * FROM tooterUser";
					$stmt = $connection -> prepare ($sql);
					$stmt -> execute();
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
                            
                            echo '<form class = "follow-form" action="main-admin-deleteuser.php" method="post">';
                            echo '<input type="text" name="profilename" value="' . $tootuser. '" hidden>';
                            echo '<button type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Delete</span></button>';
                            echo '</form>';
                            //echo '<a href="main-admin-toot?user='.$tootuser.'"><button class="follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">View Toots</span></button></a>';
                            
                            
                            echo '</div></div></div>';
                                        }
                    
			
			

 		    		

                ?>
									
                                      
                                  </div>
                                  <!-- edit-profile -->
                                  <div id="toot" class="tab-pane">
                                    
                                      <div class="main-header"><h2>Toots</h2></div>
                        <?php
				$sql = "SELECT toot_post.time, toot_post.pid ,toot_post.text, toot_post.username, toot_post.image FROM toot_post";
				$stmt = $connection -> prepare ($sql);
				$stmt -> execute();
				while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
				{
					$tweet = $row['text'];
					$tootername = $row['username'];
					$tootimage = $row['image'];
                			$toottime = $row['time'];
                            echo '<div class="toot-container">';
			    echo '<span class="toot-time">'.$toottime.'</span>';
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
							echo ' <a href="main-delete-post.php?id='.$row['pid'].'"class = "follow-button" role="button"><span class = "glyphicon glyphicon-user"></span>Delete post</a>';
                            echo '</div></div></div>';
                    }
		
		
               
                
                ?>
                                      
                                      
                                  </div>
                                  
                                  
                                  <div id="hashtag" class="tab-pane active">
                        
                                    <div class="main-header"><h2>#HashTags</h2></div>
                                  	<?php
                                    $sql = "SELECT * FROM hashtag";
                                    $stmt = $connection -> prepare ($sql);
                                    $stmt -> execute();
                                    while ($row = $stmt -> fetch(PDO::FETCH_ASSOC))
                                    {
                                        $hashword = $row['hashword'];
                                        ?>
                                    <div class="toot-container">
                                        <div class="toot-content">
                                            <strong class="toot-username"><?php echo $hashword; ?></strong>
                                            <form class = "follow-form" action="delete-hash.php" method="post">
                                                <input type="text" name="hashword" value="<?php echo $hashword; ?>" hidden>
                                                <button style="float:right;" type="submit" class = "follow-button"><span class = "glyphicon glyphicon-user"></span><span class = "follow-button-text">Delete</span></button>
                                            </form>
                                        </div>
                                    </div>
                                            <?php
                                    }
                                    
                                    ?>
                                   </div>
                          </div>
                
		
                    
                
            </div>
        </main>
   
    
        
<!--        <div class="main-content">
            
            <div class="col-md-8">
                <div style="margin: 0px 50px 0px 50px;">
                    <h2 class="sign-header">To begin, select a function from the left menu..</h2>
                    <hr>
                </div>
            </div>
        </div>-->


        <script src="js/jquery.min.js"></script>
        <script src="js/tooterjs.js"></script>
        <script src="js/filereader.js"></script>
    </body>
</html>