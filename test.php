<html>
<head>
<Title>Registration Form</Title>

<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Simple Registration Form using PHP!</h1>
<p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
    <table width="100%">
        <tr>
            <td width="5%">Name</td>
            <td><input type="text" name="name" id="name"/></td>
        </tr>
        
        <tr>
            <td>Email</td>
            <td><input type="text" name="email" id="email"/></td>
        </tr>
        
        <tr>
            <td colspan="2"><input type="submit" name="submit" value="Submit" /></td>
        </tr>
    </table>

</form>
<?php

// Author: Terence Lim
// Date: 26 Aug 2015
// Simple PHP script for Database Demo
// Adapted from: https://azure.microsoft.com/en-us/documentation/articles/web-sites-php-sql-database-deploy-use-git/

// DB connection info
// TODO: ADD IN DB CONNECTION INFORMATION
$host = "f26cqycb8t.database.windows.net";
$user = "tooterserver";
$pwd = "Password99";
$db = "tooterdb";

// Connecting to database
try {
    $conn = new PDO( "sqlsrv:Server= $host ; Database = $db ", $user, $pwd);
    $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
}
catch(Exception $e){
    die(var_dump($e));
}

// Checks if the form is submitted 
// If form is submitted, add the contents to database
/* if(!empty($_POST)) {
try {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = date("Y-m-d");
    // Insert data
    $sql_insert = "INSERT INTO registration_tbl (name, email, date) 
                   VALUES (?,?,?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bindValue(1, $name);
    $stmt->bindValue(2, $email);
    $stmt->bindValue(3, $date);
    $stmt->execute();
}
catch(Exception $e) {
    die(var_dump($e));
}
echo "<h3>Your're registered!</h3>";
} */


// Lists all the contents in the database

$sql_select = "SELECT * FROM login";
$stmt = $conn->query($sql_select);
$registrants = $stmt->fetchAll(); 
if(count($registrants) > 0) {
    echo "<h2>People who are registered:</h2>";
    echo "<table>";
    echo "<tr><th>Name</th>";
    echo "<th>Email</th>";
	echo "<th>Eimgl</th>";
	echo "<th>usna</th>";
    echo "<th>password</th></tr>";
    foreach($registrants as $registrant) {
        echo "<tr><td>".$registrant['name']."</td>";
        echo "<td>".$registrant['email']."</td>";
		echo "<td>".$registrant['image']."</td>";
		echo "<td>".$registrant['username']."</td>";
        echo "<td>".$registrant['password']."</td></tr>";
    }
    echo "</table>";
} else {
    echo "<h3>No one is currently registered.</h3>";
}

?>
</body>
</html>