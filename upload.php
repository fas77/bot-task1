<?php

$file_name = $_REQUEST['filename'] ;

$target_dir = "uploads/";
$target_file = $target_dir . basename($file_name);

if (move_uploaded_file($_FILES["filedata"]["tmp_name"], $target_file)) {
      //  echo "The file ". basename($_FILES["photo"]["name"]["image"]). " has been uploaded.";
		$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
		$txt    = "Successfull UPLOAD { $file_name } \n"."<br>".$authenticity_token;
		fwrite($myfile, $txt);
		fclose($myfile);
    } else
    {


    }

?>