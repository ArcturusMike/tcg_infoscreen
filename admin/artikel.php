<DOCTYPE html>
<html>
<head>
    <title>Artikel bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $artikel_dauer = $_POST["artikel-dauer"];
    $artikel_links = $_POST["artikel-links"];

    // Write content to artikel_dauer file
    $artikel_dauer_file = fopen("../../artikel_dauer.txt", "w") or die("Unable to open file!");
    fwrite($artikel_dauer_file, $artikel_dauer);
    fclose($artikel_dauer_file);

    // Write content to artikel file
    $artikel_links_file = fopen("../../artikel.txt", "w") or die("Unable to open file!");
    fwrite($artikel_links_file, $artikel_links);
    fclose($artikel_links_file);

    echo "<p>Homepage-Artikel erfolgreich bearbeitet.</p>";
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>