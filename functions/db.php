<?php 

$host = "localhost";
$user = "root";
$password = "";
$db = "login_db";

$conn = mysqli_connect($host, $user, $password, $db);

function escape($string){
     global $conn;
     return mysqli_real_escape_string($conn, $string);
}

function query($query){
     global $conn;
     return mysqli_query($conn, $query);
}

function fetch_array($result){
     global $conn;
     return mysqli_fetch_assoc($result);
}

function confirm($result){
     global $conn;
     if(!$result){
          die("Query Failed " .  mysqli_error($conn));
     }
}

function count_row($result){
     return mysqli_num_rows($result);
}

?>