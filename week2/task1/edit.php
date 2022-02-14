<?php


require 'connect.php';


# Fetch data based on Id ...... 
$id = $_GET['id'];
function clean($input)
    {
       $input= trim($input);
      $input=filter_var($input,FILTER_SANITIZE_STRING);
   
      return $input;
    }
    

$sql = "select * from user where id = $id";
$op  = mysqli_query($con,$sql);

$data= mysqli_fetch_assoc($op); 



if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $title = clean($_POST['title']);
    $contect=clean( $_POST['contect']);
    $date=clean( $_POST['date']);

    if (!empty($_FILES['img']['name']))
    {

     $img_name=$_FILES['img']['name'];
     $img_tmp=$_FILES['img']['tmp_name'];
     $img_type=$_FILES['img']['type'];
     $ext_array=explode( '.',$img_name);
     $extension=strtolower(end($ext_array));
     $allow_extenation=['png','jpg'];
        if(in_array($extension,$allow_extenation))
           {
             $dispath='upload/'.$img_name;
            if( move_uploaded_file($img_tmp,$dispath)==true)
               {
                echo "successed upload "."<br>";

               }
            else 
             {
                echo"failed upload"."<br>";
             }
          }
        else
        {
            echo "invailed ectension"."<br>";
        }
    }
      else
       {
        echo "image required"."<br>";
       }

    $errors = [];

    # validate name .... 
    if(empty($title))
    {
        $error['title']=" title required " ."<br>";
    }
    
    else if(strlen($title)<6)
    {
        $error['title']="required title > 6"."<br>";
    }
    if(empty($date))
    {
        $error['date']=" date required " ."<br>";
    }
    if(empty($contect))
    {
        $error['contect']="contect required" ."<br>";
    }
    else if(strlen($contect)<50)
    {
       $error[$contect] ="contect > 50 "."<br>";
    }
    

    # Check ...... 
    if (count($errors) > 0) {
        // print errors .... 

        foreach ($errors as $key => $value) 
        {
            # code...

            echo '* ' . $key . ' : ' . $value . '<br>';
        }
                         }
     else {

        # DB CODE .......  

        $sql = "update user set title = '$title' , contect = '$contect' , date='$date' ,image='$img_name' where  id = $id";

        $op  =  mysqli_query($con,$sql);


        if($op){

          $_SESSION['Message']  = 'Raw Updated'; 

          header("Location: index.php");
         


        }else{
            echo 'Error Try Again '.mysqli_error($con);
        }

        mysqli_close($con);

    }
}

/*
   
 create db   (blog)    >>> table [title , content , category ]     
 create connection by php code .... 
*/


?>




<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

    <div class="container">
        <h2>Edit Account</h2>

        <form action="edit.php?id=<?php echo $id;?>" method="post">

        <div class="form-group">
            <label for="exampleInputName">title</label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="title" placeholder="Enter Name">
        </div>


        <div class="form-group">
            <label>contect</label>
            <input type="text" class="form-control"  name="contect" placeholder="Enter contect">
        </div>
        <div class="form-group">
            <label>date</label>
            <input type="date" class="form-control"  name="date" placeholder="Enter date">
        </div>
  
        <div class="form-group">
            <label for="exampleInputName">image</label>
            <input type="file" class="form-control" name="img">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>



</body>

</html>