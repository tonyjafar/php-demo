<?php
$conn = mysqli_connect("localhost","root","","loginapp");
if (!$conn){
    die("Internal Error") . mysqli_error($conn);
}
?>