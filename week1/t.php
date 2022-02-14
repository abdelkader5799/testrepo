<?php
$s=file_get_contents('https://tools.learningcontainer.com/sample-json-file.json');
$data=json_decode($s,true);
print_r($data);




?>