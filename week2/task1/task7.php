<?php 
if($_SERVER['REQUEST_METHOD']=="POST")
{
    function clean($input)
    {
       $input= trim($input);
      $input=filter_var($input,FILTER_SANITIZE_STRING);
   
      return $input;
    }
    
$title = clean($_POST['title']);
$contect=clean( $_POST['contect']);
$date=clean( $_POST['date']);

require("connect.php");
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

$error=[];

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
else if(strlen($contect)<50 and strlen($contect)<100)
{
   $error[$contect] ="contect > 50 "."<br>";
}

if(count($error)>0)
{
    foreach($error as $value)
    {
        echo $value;

    }
       
}
else
{
    
  $sql="INSERT INTO `user`( `title`, `contect`, `date`,`image`) VALUES('$title','$contect','$date','$img_name')";

    mysqli_query($con,$sql);
      
      
}


}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>article</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <h2>Blog Module</h2>
  
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data" >

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


<br>

</body>

</html>

