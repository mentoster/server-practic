<?php
$statusMsg = '';

//file upload path
$targetDir = "/home/public_html/uploads/";
$fileName = basename($_FILES["file"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (isset($_POST["submit"]) && !empty($_FILES["file"]["name"])) {
    //allow certain file formats
    $allowTypes = array('pdf');
    if (in_array($fileType, $allowTypes)) {
        //upload file to server
        if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
            $statusMsg = "The file " . $fileName . " has been uploaded.";
        } else {
            $statusMsg = "Not uploaded because of error #" . $_FILES["file"]["error"];
        }
    } else {
        $statusMsg = 'Sorry, only PDF files are allowed to upload.';
    }
} else {
    $statusMsg = 'Please select a file to upload.';
}

//display status message
echo $statusMsg;
