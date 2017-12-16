<?php
//creating a new connection object using mysqli 
$conn =mysqli_connect('tsmsweb.clkgrrfzqfem.us-west-2.rds.amazonaws.com', 'teamone', 'tsmsweb12', 'tsmsdb', 3306);
 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>