<?php
include "header.php";
include "functions.php";
if (!isset($_COOKIE["loggidin"])){
            $newURL = "login.php";
            header('Location: '.$newURL);
}
$username = $_COOKIE["loggidin"];
$get_time = "select last_login from users where username = '$username'";
$result = mysqli_query($conn, $get_time);
while ($row = mysqli_fetch_assoc($result)){
    $last_Login = $row["last_login"];
}

?>
  <a href="signout.php">Sign Out</a>
       <br>
       <br>
       <br>
       <h1>Welcome <?php echo $_COOKIE["loggidin"]; ?></h1>
       <h3>Your last login was on <?php echo $last_Login; ?></h3>
   <div class="container">
<table class='table table-hover'>
  <thead>
    <tr>
      <th scope='col'>#</th>
      <th scope='col'>ID</th>
      <th scope='col'>Username</th>
      <th scope='col'>Last Login</th>
    </tr>
  </thead>
  <tbody>

<?php
$userState = "select * from users";
$result = mysqli_query($conn, $userState);

if ($result) {
    $x = 1;
    while ($row = mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $username = $row['username'];
        $LastLogin = $row['last_login'];
        echo "<tr><th scope='row'>$x</th><td>$id</td><td>$username</td><td>$LastLogin</td></tr>";
        $x++;
    }
    
}
?>
</tbody>
</table>
</div>
<?php
include "footer.php";
?>