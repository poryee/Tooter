<?php

//checks if user has login before
if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) 
{
    $_SESSION['error'] = '';
    $_SESSION['logintest'] = '';
    echo '<ul class="footerList">
    <li><a href="signin.php">Login</a></li>
    <li><a href="signup.php">Register</a></li>
    <li>© 2015 Tooter</li>
    </ul>';
}
else
{
    echo '<div class="footertext">© 2015 Tooter</div>';
}