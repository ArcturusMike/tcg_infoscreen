<DOCTYPE html>
<html>
<head>
    <title>PDF hochgeladen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    if(isset($_FILES["datei"])) {
        $targetDir = "../";
        $targetFile = $targetDir . basename($_FILES["datei"]["name"]);
        $uploadOk = 1;
    
        // Check if file already exists
        if (file_exists($targetFile)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }
    
        // Check file size
        if ($_FILES["datei"]["size"] > 10000000) { // larger than 10 MB
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }
    
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } 
        else {
            if (move_uploaded_file($_FILES["datei"]["tmp_name"], $targetFile)) {
                echo "The file " . basename($_FILES["datei"]["name"]) . " has been uploaded.";
            } 
            else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } 
    else {
        echo "Please select a file to upload.";
    }
?>    
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>