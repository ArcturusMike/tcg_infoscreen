<DOCTYPE html>
<html>
<head>
    <title>Mannschaften bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $mannschaften_links = $_POST["mannschaften-links"];

    // Write content to mannschaften file
    $mannschaften_links_file = fopen("../../dateien/mannschaften.txt", "w") or die("Unable to open file!");
    fwrite($mannschaften_links_file, $mannschaften_links);
    fclose($mannschaften_links_file);

    echo "<p>Mannschaften erfolgreich bearbeitet.</p>";
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>