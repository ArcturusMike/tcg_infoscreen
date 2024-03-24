<DOCTYPE html>
<html>
<head>
    <title>Datei gelöscht</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $filesToDelete = $_POST['filesToDelete'];
    foreach ($filesToDelete as $file) {
        $filePath = "../../" . $file;
        if (file_exists($filePath)) {
            unlink($filePath);
            echo "<p>Datei $file wurde gelöscht.</p>";
        } 
        else {
            echo "<p>Datei $file existiert nicht oder wurde bereits gelöscht.</p>";
        }
    }
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>