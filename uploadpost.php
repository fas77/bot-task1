<?php

if (isset($_POST['btnUpload']))
{
//$url = "URL_PATH of upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL
//$url = "http://localhost/projs/test_area/upwork/wesley/task12/upload.php";

$url = "http://faisal.alltechcommunity.com/wes/upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL

$filename = $_FILES["photo"]["name"]["image"]  ;
$filedata = $_FILES["photo"]["tmp_name"]["image"] ;
$filesize =  $_FILES["photo"]["size"]["image"]; 
if ($filedata != '')
{
    $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
    $postfields = array("filedata" => "@$filedata", "filename" => $filename);

    $ch = curl_init();
    $options = array(
        CURLOPT_URL => $url,
        CURLOPT_HEADER => true,
        CURLOPT_POST => 1,
        CURLOPT_HTTPHEADER => $headers,
        CURLOPT_POSTFIELDS => $postfields,
        CURLOPT_INFILESIZE => $filesize,
        CURLOPT_RETURNTRANSFER => true
    ); // cURL options
    curl_setopt_array($ch, $options);
    curl_exec($ch);    
    

    if(!curl_errno($ch))
    {
        $info = curl_getinfo($ch);

        //echo "<pre>";
        //var_dump($info);
        //echo "</pre>";

        if($info['http_code'] == 200)
            $errmsg = "File uploaded successfully";
    }
    else
    {
        $errmsg = curl_error($ch);
    }
    curl_close($ch);
}
else
{
    $errmsg = "Please select the file";
}
}

?>