<?php
session_start();
if($currentPage == "index.php" || $currentPage == "signin.php" || $currentPage == "signup.php")
{
    if ((isset($_SESSION['login']) && $_SESSION['login'] != '')) 
    {
        header ("Location: main.php");
    }
}
else
{
    if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
    {
        header ("Location: signin.php");
    }
    else
    {
        $username = $_SESSION['userlogin'];
        $name = $_SESSION['name'];
    }
}




