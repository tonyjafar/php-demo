<?php 
if (isset($_COOKIE["loggidin"])){
    $name = "loggidin";
    $value = "";
    unset($_COOKIE[$cookie_name]);
    setcookie($name, '', time() - 3600);
    $newURL = "index.php";
    header('Location: '.$newURL);
}else{
    $newURL = "login.php";
    header('Location: '.$newURL);
}

?>