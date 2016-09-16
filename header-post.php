<?php
$currentpage = basename($_SERVER['SCRIPT_FILENAME']);

$search = isset($_GET['search']) ? $_GET['search'] : '';
if ($search != '' && $currentpage != 'search.php') {
    header('location: search.php?search=' . $search);
}

$profilename = isset($_GET['user']) ? $_GET['user'] : '';
//$profilematch= mysqli_query($connection, "SELECT username FROM login WHERE username = '".mysql_real_escape_string($profilename)."'");

$profilematch = "SELECT username FROM tooterUser WHERE username = ?";
$stmt2 = $connection -> prepare ($profilematch);
$stmt2 -> bindValue(1, $profilename);
$stmt2 -> execute();
$result = $stmt2->fetchAll();
$namerows = count($result);

//$namerows = mysqli_affected_rows($connection);
if ($profilename == '' && $currentPage == 'profile.php'){
    header('location: main.php');
}
else if ($namerows == 0 && $currentPage == 'profile.php'){
    header('location: main.php');
}
else if ($profilename != '' && $currentPage != 'profile.php') {
    header('location: profile.php?user=' . $profilename);
}

/* $imageresult= mysqli_query($connection, "SELECT image FROM login WHERE username = '".mysql_real_escape_string($username)."'");
$imagerow=mysqli_fetch_assoc($imageresult);
$image=$imagerow['image']; */

$image = $_SESSION['image'];

$isAdmin = $_SESSION['admin'];
?>

<!--
HEADER TO DISPLAY AFTER LOGGING IN
-->
<nav id="navbar" class="navbar navbar-default" role="navigation" style="background-color:#fff;">
    <div class="container-fluid">                  
        <div id="navbar-full">
            <ul>
                <li <?php
                if ($currentPage == "main.php") {
                    echo 'class="highlight"';
                }
                ?>>
                    <?php
                    if($isAdmin != 1)
                    {
                    ?>
                    <a href="main.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <a href="main-admin.php"><span class="glyphicon glyphicon-home"></span>Home</a></li>
                    <?php
                    }
                    ?>
                    <?php
                    if($isAdmin != 1)
                    {
                    ?>
                        <li >
                        <a href="notifications.php"><span class="glyphicon glyphicon-bell"></span>Notifications</a></li>
                    <?php
                    }
                    ?>
                <li><a href="signout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
            <a class="navlogo" href="main.php"><img alt="Tooter" src="images/logo.png"></a>
            
            <form name="searchform" style="width: 300px;" class="nav-form" role="search">
                <?php
                if($isAdmin != 1)
                    {
                echo '<a href="profile.php?user='.$username.'">';
                ?>
                
                <img style="border-style: solid; border-width: 1px;" src='<?php echo $image ?>' class="nav-toot-dp"/></a>
            <?php
                    }
                    ?>
            
             <?php
                    if($isAdmin != 1)
                    {
                    ?>
                <div class="form-group" method="post" action="search.php">
                    <input type="text" style="width: 196px;" name="search" id="searchtext" class="form-control" placeholder="Search">
                </div>
                
            </form>
            <button id="searchsub" class="btn btn-default">Submit</button>
            <?php
                    }
                    ?>
        </div>
    </div>
</nav>