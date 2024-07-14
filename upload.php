<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $asset = $_POST['asset'];
    $target_dir = "uploads/";
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Allowed file types
    $allowedTypes = array('pdf', 'doc', 'docx', 'xls', 'xlsx');

    // Check if file type is allowed
    if (!in_array($fileType, $allowedTypes)) {
        echo "Sorry, only PDF, DOC, DOCX, XLS, and XLSX files are allowed.";
        $uploadOk = 0;
    }

    // Check file size (adjust as necessary)
    if ($_FILES["fileToUpload"]["size"] > 5000000) { // 5 MB limit
        echo "Sorry, your file is too large. Maximum file size is 5 MB.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            // Update the `attachment` column in the database
            $sql = "UPDATE scrap SET attachement='$target_file' WHERE assets='$asset'";
            if ($conn->query($sql) === TRUE) {
                echo "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Error updating record: " . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}
?>
