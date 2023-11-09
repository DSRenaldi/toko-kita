<?php
$connect = mysqli_connect("db", "root", "root", "eda");
if (!$connect) {
    die("Failed to connect: " . mysqli_connect_error());
}
