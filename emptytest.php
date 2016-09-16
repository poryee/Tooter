<?php
include 'connectDB.php';
$q = 'fen';
    

     $sql2 = "select username, userimage from tooterUser where username like '%".$q."%'";
     
     $stmt2 = $connection -> prepare ($sql2);
     $stmt2 -> execute();
     echo "test";
     //$data = $stmt2->fetch();
     //echo $stmt2->fetch();
     //echo $data['userimage'];
     //$result = sqlsrv_query($connection, $sql);
     //$num_rows = $stmt2->rowcount();
     //$data2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
     
     echo "asdsadasdas";
     $i = 0;
     
     
     
     //while($row = $stmt2->fetch(PDO::FETCH_ASSOC)){
         
     //while($data[$i]){
     while ($row = $stmt2 -> fetch(PDO::FETCH_ASSOC)){
     //foreach ($stmt2->fetchAll(PDO::FETCH_ASSOC) as $row) {
        //print $row;

         echo "dsa";
         //if($result) {
             //while ($row = $stmt2 -> fetch()) {
                
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
             
         //}
     }