<?php 

$serverName="localhost";
$databaseuser="root";
$databasePassword="";
$databaseName="nana_digital";

$conn=mysqli_connect($serverName,$databaseuser,$databasePassword,$databaseName);
if(!$conn){
    echo "Database connection failed ";
}

?>

