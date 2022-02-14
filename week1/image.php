<?php
session_start();
if($_SERVER['REQUEST_METHOD']=='POST')
{
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
                echo "successed upload ";

               }
            else 
             {
                echo"failed upload";
             }
          }
        else
        {
            echo "invailed ectension";
        }
    }
      else
       {
        echo "image required";
       }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>upload</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>

<div class="container">
    <h2>image</h2>
  
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"  enctype="multipart/form-data">

        <div class="form-group">
            <label for="exampleInputName">Name</label>
            <input type="file" class="form-control"    name="img">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<br>

</body>

</html>
