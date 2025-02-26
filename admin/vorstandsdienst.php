<DOCTYPE html>
<html>
<head>
    <title>Vorstandsdienst bearbeitet</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
    $vd_wochen = $_POST["vorstandsdienst-wochen"];
    $vd_namen = $_POST["vorstandsdienst-namen"];

    // Write content to vd_wochen file
    $vd_wochen_file = fopen("../../dateien/vorstandsdienst_wochen.txt", "w") or die("Unable to open file!");
    fwrite($vd_wochen_file, $vd_wochen);
    fclose($vd_wochen_file);

    // Write content to vd file
    $vd_namen_file = fopen("../../dateien/vorstandsdienst_namen.txt", "w") or die("Unable to open file!");
    fwrite($vd_namen_file, $vd_namen);
    fclose($vd_namen_file);

    echo "<p>Vorstandsdienst erfolgreich bearbeitet.</p>";
?>
<p><a href="index.php">Zurück zur Admin-Seite</a></p>
</body>
</html>