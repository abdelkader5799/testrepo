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
$image_name=$_FILES['img']['name'];
$image_tmp=$_FILES['img']['tmp_name'];
if(!empty($image_name))
   {
      $arr_name=explode('.',$image_name);
      $extension=strtolower(end($arr_name));
      $allow_ext=['png','jpg'];
      if(in_array($extension,$allow_ext))
        {
            $dispath='upload/'.$image_name;
            if(move_uploaded_file($image_tmp,$dispath))
              {
                  echo "successed uploaded"."<br>";
              }
            else
               {
                echo "failed uploaded"."<be>";

               }   
        }
      else
         {
             echo "invailed extension"."<br>";
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
if(empty($contect))
{
    $error['contect']="contect required" ."<br>";
}
else if(strlen($contect)<50 and strlen($contect)<100)
{
    $error[$contect] ="contect > 50 and <100 "."<br>";
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
    
  $data=fopen('mahmoud.txt','a');
            
        fwrite($data,$title);
        fwrite($data,"\n");
        fwrite($data,$contect);
        fwrite($data,"\n");
        fwrite($data,$image_name);
        fwrite($data,"\n");
    
       $data= fopen('mahmoud.txt','r');
    
       while(!feof($data))
       {
           echo fgets($data)."<br>";
       }

    
      
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
            <label>category</label>
            <input type="text" class="form-control"  name="category" placeholder="Enter category">
        </div>



        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<br>

</body>

</html>

