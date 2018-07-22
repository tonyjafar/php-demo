<?php 
include "functions.php"; 
include "header.php";
?>

<?php
    $addError = False;
    $userError = False;
    $compError = False;
    $errorFree = False;
    if (isset($_POST['submit'])){
        if ($_POST['username'] && $_POST['password']){
            $username = mysqli_real_escape_string($conn,$_POST['username']);
            $password = mysqli_real_escape_string($conn,$_POST['password']);
            $check_query = "Select username from users where username = '$username'";
            $result = mysqli_query($conn, $check_query);
            if (mysqli_num_rows($result) == 0){
                $hash = "$2y$10$";
                $salt = "mysuperoverkillingsaltiwillnverused";
                $hashSalt = $hash . $salt;
                $passwordC = crypt($password, $hashSalt);
                $addQuery = "insert into users (username, password) values ('$username', '$passwordC')";
                $result = mysqli_query($conn, $addQuery);
                if (!$result){
                    $addError = True;
                }else{
                    $errorFree = True;
                }
            }else{
                $userError = True;
            }
        }else{
            $compError = True;
        }
    }
    
    
?>
   <div class="container">
       <div class="col-sm-6">
       <a href="index.php">Back To Home</a>
       <br>
       <br>
       <br>
    <form action="create.php" method="post">
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
        <input class="btn btn-primary" type="submit" value="Register" name="submit">
        </div>
    </form>
       </div>
    <br>
    <?php
    if ($addError){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Internal Error please try again later</h3>";
        echo "</div>";
    }elseif ($userError){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>User is already in DB</h3>";
        echo "</div>";
    }elseif ($compError){
        echo "<div class='alert alert-danger' role='alert'>";
        echo "<h3>Please fill in all fields</h3>";
        echo "</div>";
    }elseif ($errorFree){
        echo "<div class='alert alert-success' role='alert'>";
        echo "User added successfully";
        echo "</div>";
    }
    include "footer.php";
    ?>