<?php
session_start();
$conn = mysqli_connect("localhost", "root", "Rakesh@9204", "tpc");

// Check if the connection was successful
if (!$conn) {
    echo "failed";
    die("Connection failed: " . mysqli_connect_error());
}
?>
