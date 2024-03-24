<DOCTYPE html>
<html>
<head>
    <title>PDFs bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $pdfs_dauer = $_POST["pdfs-dauer"];
    $pdfs_namen = $_POST["pdfs-namen"];

    // Write content to pdfs_dauer file
    $pdfs_dauer_file = fopen("../../dateien/pdfs_dauer.txt", "w") or die("Unable to open file!");
    fwrite($pdfs_dauer_file, $pdfs_dauer);
    fclose($pdfs_dauer_file);

    // Write content to pdfs file
    $pdfs_namen_file = fopen("../../dateien/pdfs.txt", "w") or die("Unable to open file!");
    fwrite($pdfs_namen_file, $pdfs_namen);
    fclose($pdfs_namen_file);

    echo "<p>PDFs erfolgreich bearbeitet.</p>";
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>