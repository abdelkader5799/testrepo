<?php 

require 'connect.php';

 $id = $_GET['id'];
 
 $sql = "delete from user where id = $id";

 $op = mysqli_query($con,$sql);


 if($op){
    $Message =  'Raw Removed';
 }else{
    $Message = 'Error Try Again';
 }


  # SET  ERROR   SESSION .... 

  $_SESSION['Message'] = $Message;


   header("location: index.php");


?>