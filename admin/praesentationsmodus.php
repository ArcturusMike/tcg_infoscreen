<DOCTYPE html>
<html>
<head>
    <title>Artikel bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $praesentationsmodus = $_POST["praesentationsmodus"];
    $praesentationsmodus_seiten = $_POST["praesentationsmodus-seiten"];

    // Write content to praesentationsmodus file
    $praesentationsmodus_file = fopen("../../dateien/praesentationsmodus.txt", "w") or die("Unable to open file!");
    fwrite($praesentationsmodus_file, $praesentationsmodus);
    fclose($praesentationsmodus_file);

    // Write content to praesentationsmodus_seiten file
    $praesentationsmodus_seiten_file = fopen("../../dateien/praesentationsmodus_seiten.txt", "w") or die("Unable to open file!");
    fwrite($praesentationsmodus_seiten_file, $praesentationsmodus_seiten);
    fclose($praesentationsmodus_seiten_file);

    if ($praesentationsmodus == "") {
        echo "<p>Präsentationsmodus erfolgreich DEAKTIVIERT.</p>";
    }
    else {
        echo "<p>Präsentationsmodus erfolgreich AKTIVIERT.</p>";
    }

?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>