<?php
// Define the directory to save uploaded files
$target_dir = "uploads/";

// Create uploads directory if it doesn't exist
if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Get the file information
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if the file is a real image or just a fake one
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".<br>";
        $uploadOk = 1;
    } else {
        echo "File is not an image.<br>";
        $uploadOk = 0;
    }
}

// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.<br>";
    $uploadOk = 0;
}

// Check file size (limit to 10MB for example)
if ($_FILES["fileToUpload"]["size"] > 10000000) {
    echo "Sorry, your file is too large.<br>";
    $uploadOk = 0;
}

// Allow certain file formats
if ($fileType != "jpg" && $fileType != "png" && $fileType != "jpeg" && $fileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.<br>";
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.<br>";
    } else {
        echo "Sorry, there was an error uploading
