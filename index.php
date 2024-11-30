<?php
// upload.php

// Directory to store the uploaded file
$target_dir = "uploads/";

// Create the uploads directory if it doesn't exist
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Check if file is an actual image (optional step)
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        exit;
    }
}

// Allow certain file formats (optional step)
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    exit;
}

// Try to upload the file
if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
    // Redirect back to the main page to display the image
    header("Location: index.php?image=" . urlencode($target_file));
    exit;
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
