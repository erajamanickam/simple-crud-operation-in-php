<?php
$conn=mysqli_connect("localhost", "root", "", "crud-php");
// $conn = mysqli_connect("servername", "username", "password", "db name");
    if(mysqli_connect_errno()) {
        echo "Connection Fail".mysqli_connect_error();
    }
?>
