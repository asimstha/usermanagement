<?php 
ob_start();
 

    // Set sessions
    if(!isset($_SESSION)) {
        session_start();
    }

    
    
    $hostname = "localhost";
    $username = "id16472060_root";
    $password = 'r+IY~P0Y$pzimI2i';
    $dbname = "id16472060_projects";
    
    $connection = mysqli_connect($hostname, $username, $password, $dbname) or die("Database connection not established.")
?>