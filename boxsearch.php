<?php
$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

$sql = "SELECT userimage FROM tooterUser WHERE username = '".$username."'";
$stmt = $connection -> prepare($sql);
$stmt -> execute();

$image = $stmt->fetchColumn(0);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
     $q = $_POST['searchword'];
     $q = str_replace("@","",$q);
     $q = str_replace(" ","%",$q);
    
     $sql2 = "select username, userimage from tooterUser where username like '%".$q."%'";
     $stmt2 = $connection -> prepare ($sql2);
     $stmt2 -> execute();
     
     
             while ($row = $stmt2 -> fetch(PDO::FETCH_ASSOC)){
             $fname = $row['username'];  
             $userimage = $row['userimage'];
?>
<a href="#" class="toot-search-addname-link" id="addLink<?php echo($i);  $i++;?>" onclick="addName(this)" title='<?php echo $fname; ?>'>
    <div class="toot-search-addname" >
        <img class="toot-search-addname-img" src="<?php echo $userimage; ?>">
        <span class="toot-search-addname-name"><?php echo $fname; ?></span>
        <span class="toot-search-addname-id">@<?php echo $fname; ?></span>
    </div>
</a>
<?php
            
         
     }
}
