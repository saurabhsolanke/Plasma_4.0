<?php

session_start();
include "conn.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query("DELETE FROM users where id = '$id'"); // delete query
$query_run = mysqli_query($conn,$del);

?>