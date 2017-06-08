<?php

if (isset($_POST['btnUpload']))
{
//$url = "URL_PATH of upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL
//$url = "http://localhost/projs/test_area/upwork/wesley/task12/upload.php";
//$url = "http://faisal.alltechcommunity.com/wes/upload.php"; // e.g. http://localhost/myuploader/upload.php // request URL

$url = "http://ourdesigngroup.com/photos"; 

$filename = $_FILES["photo"]["name"]["image"]  ;
$filedata = $_FILES["photo"]["tmp_name"]["image"] ;
$filesize =  $_FILES["photo"]["size"]["image"]; 
if ($filedata != '')
{

    $headers = array("Content-Type:multipart/form-data"); // cURL headers for file uploading
    $postfields = array("photo[image]" => "@$filedata",
        "photo[title]" => $filename,
        "commit" => "Upload",
        "method" => "post",
        "authenticity_token" => "rYX8zfajGHRDuobDMgPap+wq0Mkvf8NwvPjxj/L7XfI5a+kIjhHFNdvUSzh2nQ97k5fD4Ma9HzTYPDEfIuwEFQ==",
        "utf8" => "&#x2713;"
        );

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
    
//var_dump(curl_errno($ch));

//die('line 42');

    if(!curl_errno($ch))
    {
        $info = curl_getinfo($ch);

        echo "<pre>";
        var_dump($info);
        echo "</pre>";

        var_dump($info['http_code']);
        exit;

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