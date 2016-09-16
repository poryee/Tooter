<?php
    $sql= "SELECT * FROM toot ORDER BY pid DESC";                          
    if ($result= mysqli_query($connection, $sql)){
        while ($row= mysqli_fetch_assoc($result)){
            echo '<div class="toot-container">';                        
            echo '<div class="toot-content">';
            echo '<img src="css/bgImages/bg1.jpg" class="toot-dp">';
            echo '<div class="toot-content-data">';
            echo '<strong class="toot-username"><a href="profile.php?user='.$row['username'].'">';
            echo $row['username'];
            echo '</a></strong><span class="toot-profilename">';            
            echo '@'.$row['username'];
            echo '</span>';
            echo '<p class="toot">';
            echo $row['text'];
            echo '</p>';
            if ($row['image']!=''){
            echo '<div style="margin-top:4%; margin-bottom:4%;">';
            echo '<a href="profile.php?user='.$row['username'].'"><img style="height:auto; width:500px; " src="';
            echo $row['image'];
            echo '"></a>';
            echo '</div>';
            }
            echo '<div class="toot-buttons">';
            echo '<a href="#" ><span title="Reply" class="glyphicon glyphicon-bullhorn"></span></a>';
            echo '<a href="#" class="toot-buttons-rt"><span title="Retoot" class="glyphicon glyphicon-retweet"></span></a>';
            echo '<a href="delete.php?idd='.$row['pid'].'" class="toot-buttons-rt"><span title="Delete" class="glyphicon glyphicon-trash"></span></a>';
            echo '</div></div></div></div>';
        }
    }

?>

