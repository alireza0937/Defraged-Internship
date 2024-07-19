<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload File</title>
</head>
<body>
    <form action="upload_file.php" method="post" enctype="multipart/form-data">
    <label for="file">Choose your file:</label><br><br>
        <input type="file" name="file" required><br><br>
        <label for="file_name">Your file name:</label> <br><br>
        <input type="text" name="file_name" required><br><br>
        <label for="description">description:</label><br><br>
        <textarea name="description" required></textarea><br><br>
        <button>Submit</button>
    </form>
    <br>
</body>
</html>
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];
    $file_name = $_POST['file_name'];
    $description = $_POST["description"];
    $allowed_images = ["image/png", "image/jpeg"];
    $allowed_text = ["text/plain"];
    $max_image_size = 1000000;
    $max_text_file_size = 512000;
    $targetDir = "";

    if (empty($file) or empty($file_name) or empty($description)) {
        echo "Invalid or incomplete inputs!";
        exit;
    }

    $file_name = $_FILES["file"]["name"];
    $file_format = mime_content_type($file['tmp_name']);
    $file_size = $_FILES["file"]["size"];

    if (in_array($file_format, $allowed_images) and $file_size <= $max_image_size) {
        $targetDir = "images/";
    }
    elseif (in_array($file_format, $allowed_text) and $file_size <= $max_text_file_size) {
        $targetDir = "text/";
    }
    else {
        echo "Unsupported format or The file size exceeds the limit.";
        exit;
    }

    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $filepath = $targetDir . $file_name;

    if (file_exists($filepath)) {
        echo "The file name already exists.";
        exit;
    } 

    if (move_uploaded_file($file['tmp_name'], $filepath)) {
        echo "The file has been uploaded.";
    } 
    else {
        echo "There was an error uploading your file.";
    }

}
?>