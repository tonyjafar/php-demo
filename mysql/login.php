<?php
include "header.php";
include "functions.php";
$userError = False;
$loggedIn = False;
$fieldsError = False;
if (isset($_POST['submit'])){
    if ($_POST['username']){
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $getPassState = "select password from users where username = '$username'";
        $result = mysqli_query($conn, $getPassState);
        if ($result){
            if (mysqli_num_rows($result) > 0){
                while ($dbPass = mysqli_fetch_assoc($result)){
                    $dbPassCheck = $dbPass['password'];
                    if (password_verify($password, $dbPassCheck)){
                        $loggedIn = True;
                        $name = "loggidin";
                        $value = $username;
                        $expire = time() + (60 * 60 * 24);
                        setcookie($name, $value, $expire);
                        $loginTime = date("Y-m-d H:i:s");
                        $timeState = "update users set last_login = '$loginTime' where username = '$username'";
                        $result = mysqli_query($conn, $timeState);
                        if (!$result){
                            die(mysqli_error($conn));
                        }
                    }else{
                        $userError = True;
                    }
                }
            }else{ 
                $userError = True;
            }
        }else{
            $userError = True;
        }
    }else{
        $fieldsError = True;
    }
}
?>
<div class="container">
      <?php
        if (isset($_COOKIE["loggidin"])){
            $name = "loggidin";
            $value = $username;
            $expire = time() + (60 * 60 * 24);
            setcookie($name, $value, $expire);
            $newURL = "usersList.php";
            header('Location: '.$newURL);
        }
      ?>
       <div class="col-sm-6">
       <a href="index.php">Back To Home</a>
       <br>
       <br>
       <br>
    <form action="login.php" method="post">
      <div class="form-group">
       <label for="email">Email</label>
        <input class="form-control" type="email" name="username" placeholder="E-mail">
       </div>
        <br>
        <br>
        <div class="form-group">
        <label for="password">Password</label>
        <input class="form-control" type="password" name="password" placeholder="password">
        </div>
        <br>    
        <div class="form-group">
        <input class="btn btn-primary" type="submit" value="Login" name="submit">
        </div>
    </form>
       </div>
    <br>
 <?php
    if ($userError){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Username or password are not correct</h3>";
        echo "</div>";
    }elseif ($fieldsError){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Please fill in all fields</h3>";
        echo "</div>";
    }elseif ($loggedIn){
        $name = "loggidin";
        $value = $username;
        $expire = time() + (60 * 60 * 24);
        setcookie($name, $value, $expire);
        $newURL = "usersList.php";
        header('Location: '.$newURL);
    }
    include "footer.php"; 
?>
