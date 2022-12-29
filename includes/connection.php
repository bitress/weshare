<?php

$localhost = "localhost";
$username = "root";
$password = "@Cyanne01";
$database = "weshare";

$con = new mysqli($localhost, $username, $password, $database);

if ($con->connect_errno){
    echo "Error: ". $con->connect_error;
}
session_start();
