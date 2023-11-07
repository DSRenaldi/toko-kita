<?php
$connect = mysqli_connect("localhost", "root", "", "eda");

if(!$connect) {
    die("Failed to connect: " . mysqli_connect_error());
}
?>