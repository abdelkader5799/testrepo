<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
    function clean($input)
    {
        $input=trim($input);
        $input=filter_var($input,FILTER_SANITIZE_STRING);
        return $input;

    }
$name=clean($_POST['name']);
$email=clean($_POST['email']);
$password=clean($_POST['password']);
$img_name=$_FILES['img']['name'];
$img_tmp=$_FILES['img']['tmp_name'];
if(!empty($img_name))
   {
    $arr_name=explode('.',$img_name);
    $extension=strtolower(end($arr_name));
    $allow_ext=['png','jpg'];
    if(in_array($extension,$allow_ext))
        {
          $dis_path='upload/'.$img_name;
          if(move_uploaded_file($img_tmp,$dis_path)==true)
             {
                 echo "seccessed upload"."<br>";
             }
           else
            {
                "failed upload"."<br>";
            }  
        }
    else
    {
        echo "invailed extension"."<br>";
    }   
   }
else
  {
      echo " image required"."<br>";
  }

$error=[];
    if(empty($name))
    { 
        $error[$name]="name required"."<br>";
    }
    if(empty($password))
    { 
        $error[$password]="password required";
    }
    elseif(strlen($password)<=6)
    {
        $error[$password]=" password must >= 6"."<br>";
    }
    if(empty($email))
    { 
        $error[$email]="email required"."<br>";
    }
    elseif(filter_var($email,FILTER_VALIDATE_EMAIL)==false)
    {
        $error[$email]="ENTER correct email";
 
    }

    if(count($error)>0)
    {
      foreach($error as $value)
        {   
        echo $value . "<br>";   
        }
     }
     
     else
     {
        

     }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Register</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <h2>Register</h2>
  
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data"  >

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="text" class="form-control" id="exampleInputName" aria-describedby=""   name="name" placeholder="Enter Name">
        </div>


        <div class="form-group">
            <label for="exampleInputEmail">Email address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Enter email">
        </div>

        <div class="form-group">
            <label for="exampleInputPassword">New Password</label>
            <input type="password" class="form-control" id="exampleInputPassword1"  name="password" placeholder="Password">
    
            </div>
            <div class="form-group">
            <label for="exampleInputName">image</label>
            <input type="file" class="form-control" id="exampleInputName" aria-describedby=""   name="img" placeholder="Enter Name">
            </div>




        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<br>

</body>

</html>
