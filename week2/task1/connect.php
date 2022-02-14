<?php
session_start();
$server="localhost";
$user="root";
$dbname="blog";
$password="";
$con=new mysqli($server,$user,$password,$dbname);
if(!$con)
{
    echo "error";
}

?>