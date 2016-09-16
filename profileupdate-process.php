<?php

$currentPage = basename($_SERVER['SCRIPT_FILENAME']);
include 'connectDB.php';
include 'checkSession.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newname = $_POST['username'];
    $newemail = $_POST['email'];
    $maxsize = 2097152;
    $image_type = $_FILES['image']['type'];
    $coverimage_type = $_FILES['coverimage']['type'];
    $imagesizedata = $_FILES['image']['size'];
    $coverimagesizedata = $_FILES['coverimage']['size'];
    $allowedImages = array('image/jpg', 'image/jpeg', 'image/png', 'image/gif');
    $file1 = $_FILES['image']['tmp_name'];
    $file2 = $_FILES['coverimage']['tmp_name'];
    
    if ($_POST['username'] === '') 
    {
        $newname = $username;
    } 
    else 
    {
        $newname = $_POST['username'];
    }


    if (isset($file1)) {
        if (file_exists($file1)) {
            if ($imagesizedata === FALSE) {
                header('location:profile-settings.php');
                die();
            } else if ($imagesizedata >= $maxsize) {
                header('location:profile-settings.php');
                die();
            } else if (in_array($image_type, $allowedImages) === FALSE) {
                header('location:profile-settings.php');
                die();
            }
        }
    }
    if (isset($file2)) {
        if (file_exists($file2)) {
            if ($coverimagesizedata === FALSE) {
                header('location:profile-settings.php');
                die();
            } else if ($coverimagesizedata >= $maxsize) {
                header('location:profile-settings.php');
                die();
            } else if (in_array($coverimage_type, $allowedImages) === FALSE) {
                header('location:profile-settings.php');
                die();
            }
        }
    }
    if ($_POST['email'] === '') {
        /*         $email = mysqli_query($connection, "SELECT email FROM tooterUser WHERE username = '".mysql_real_escape_string($username)."'");
          $emailrow = mysqli_fetch_assoc($email);
          $newemail = $emailrow['email']; */
        $sql_email = "SELECT email FROM tooterUser WHERE username = '" . $username . "'";
        $stmt = $connection->query($sql_email);
        $result = $stmt->fetchAll();
        $emailRow = $result[0];
        $newemail = $emailRow[email];
    } else {
        $newemail = $_POST['email'];
    }
    $image_temp = $_FILES['image']['tmp_name'];
    $coverimage_temp = $_FILES['coverimage']['tmp_name'];
    $image_name = $_FILES['image']['name'];
    $coverimage_name = $_FILES['coverimage']['name'];
    $coverimage_type = $_FILES['coverimage']['type'];
    $upload = move_uploaded_file($image_temp, "DisplayImages/" . $image_name);
    $coverupload = move_uploaded_file($coverimage_temp, "CoverImages/" . $coverimage_name);
    if (empty($file1)) {
        /*         $image = mysqli_query($connection, "SELECT image FROM login WHERE username = '".mysql_real_escape_string($username)."'");
          $imagerow = mysqli_fetch_assoc($image);
          $image_link = $imagerow['image']; */
        $sql_userimage = "SELECT userimage FROM tooterUser WHERE username = '" . $username . "'";
        $stmt2 = $connection->query($sql_userimage);
        $result2 = $stmt2->fetchAll();
        $userimageRow = $result2[0];
        $image_link = $userimageRow[userimage];
    } else {
        $image_link = "DisplayImages/" . $image_name;
        $_SESSION['image'] = $image_link;
    }
    if (empty($file2)) {
        /*         $coverimage = mysqli_query($connection, "SELECT coverimage FROM login WHERE username = '".mysql_real_escape_string($username)."'");
          $coverimagerow = mysqli_fetch_assoc($coverimage);
          $coverimage_link = $coverimagerow['coverimage']; */
        $sql_coverimage = "SELECT coverimage FROM tooterUser WHERE username = '" . $username . "'";
        $stmt3 = $connection->query($sql_coverimage);
        $result3 = $stmt3->fetchAll();
        $coverimageRow = $result3[0];
        $coverimage_link = $coverimageRow['coverimage'];
    } else {
        $coverimage_link = "CoverImages/" . $coverimage_name;
        $_SESSION['coverimage'] = $coverimage_link;
    }


    $sql = "UPDATE tooterUser SET username= '" . $newname . "', email='" . $newemail . "', userimage='" . $image_link . "', coverimage='" . $coverimage_link . "' WHERE username= '" . $username . "'";
    $stmt4 = $connection->prepare($sql);

    $stmt4->execute();

    $sql7 = "UPDATE follows SET following= '" . $newname . "' WHERE following= '" . $username . "'";
    $stmt7 = $connection->prepare($sql7);
    $stmt7->execute();
    
    /*
      $sql1 = "UPDATE toot_post SET username= '" . $newname . "' WHERE username= '" . $username . "'";
      $stmt5 = $connection->prepare($sql1);
      $stmt5->execute();

      $sql2 = "UPDATE follows SET username= '" . $newname . "' WHERE username= '" . $username . "'";
      $stmt6 = $connection->prepare($sql2);
      $stmt6->execute();

      $sql3 = "UPDATE follows SET following= '" .$newname . "' WHERE following= '" . $username . "'";
      $stmt7 = $connection->prepare($sql3);
      $stmt7->execute();
     */
    session_start();
    if (isset($_SESSION['username'])) {
        $_SESSION['username'] = $newname;
    }
    $_SESSION['userlogin'] = $newname;
    $_SESSION['email'] = $newemail;
    
    header('location:profile-settings.php');
    // $username = $_SESSION['username'];

    /*     mysqli_query($connection, $sql);
      mysqli_query($connection, $sql1);
      mysqli_query($connection, $sql2);
      mysqli_query($connection, $sql3); */


    /*     $SQL = 'SELECT * FROM login WHERE username = "'.mysql_real_escape_string($_SESSION['userlogin']) . '"';
      $result = mysqli_query($connection, $SQL);
      $uname = $_SESSION['userlogin']; */

    
}