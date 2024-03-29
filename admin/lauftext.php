<DOCTYPE html>
<html>
<head>
    <title>Lauftext bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $lauftext = $_POST["lauftext"];

    // Write content to artikel_dauer file
    $lauftext_file = fopen("../../dateien/lauftext.txt", "w") or die("Unable to open file!");
    fwrite($lauftext_file, $lauftext);
    fclose($lauftext_file);

    echo "<p>Lauftext erfolgreich bearbeitet.</p>";
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>