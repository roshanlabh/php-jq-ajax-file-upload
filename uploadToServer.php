<?php
// die('dfsf1111');
// session_start();
$allowedExts = array("vcd", "toast", "iso", "bin", "exe", "bat", 'jpg', 'jpeg', 'gif', 'png');
// echo "<pre>"; print_r($_FILES); echo "<pre>";
// $k = array_key_exists($extension, $allowedExts);
if ($_POST['pcNo']) {
    $pc_number = $_POST['pcNo'];
} else {
    die("Error: Please try after some time.");
}
$fileName      = $_FILES['file_data']['name'];
$fileSize      = $_FILES['file_data']['size'];
$fileTmpName   = $_FILES['file_data']['tmp_name'];
$fileType      = $_FILES['file_data']['type'];
$fileExtension = strtolower(end(explode('.', $fileName)));

$userUploadFolder = 'uploads/' . $pc_number;
if (!is_dir($userUploadFolder . "/")) {
    mkdir($userUploadFolder . "/");
}
$maxsize = 20 * 1024 * 1024;

if ($fileSize > $maxsize)
    die("Error: File size is larger than the allowed limit.");
// Verify MYME type of the file
if (in_array($fileExtension, $allowedExts)) {
	// Check whether file exists before uploading it
	// echo "<br />".$userUploadFolder . "/" . $fileName;
    if (file_exists($userUploadFolder . "/" . $fileName))
        echo $userUploadFolder . "/" . $fileName . " is already exists.";
    else {
        if (move_uploaded_file($fileTmpName, $userUploadFolder . "/" . $fileName))
            echo 1;
        else
            echo 0;
    }
} else {
    die("Error: file extension not supported");
}