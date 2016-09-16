
<?php

//checks if user has login before

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
{
    include('header-pre.php');
}
else
{
    include('header-post.php');
}