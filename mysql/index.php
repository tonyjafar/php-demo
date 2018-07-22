<?php
    
    include "header.php";
    if (isset($_COOKIE["loggidin"])){
        $name = "loggidin";
        $value = True;
        $expire = time() + (60 * 60 * 24);
        setcookie($name, $value, $expire);
        $newURL = "usersList.php";
        header('Location: '.$newURL);
        }

?>
<div class="container">
<h1>Welcom To Register/Login Test system</h1>
<h2>Please select Register or Login bellow or see <a href="usersList.php">users list</a></h2>
<a href="create.php">Register</a><br>
<a href="login.php">Login</a>
</div>
<?php
    
    include "footer.php";

?>