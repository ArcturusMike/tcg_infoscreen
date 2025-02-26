<!DOCTYPE html>
<html>
<head>
    <title>TCG Infoscreen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <?php include "script.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body onload="uhrzeit(); lauftextCheck(); rotationen();">
    <?php /*error_reporting(0);*/ ?>
    <div class="container-fluid main-container">
        <?php
            $now = new DateTime();
            $dayOfWeek = $now->format('w'); // Sunday is 0
            $hours = $now->format('G'); // 24-hour format of an hour without leading zeros
            $minutes = $now->format('i'); // Minutes with leading zeros
            $month = $now->format('n'); // January is 1, May is 5, July is 7
            
            // Präsentationsmodus
            if (file_get_contents("../dateien/praesentationsmodus.txt") != "") {
                include "platzreservierung.html";
                include "praesentation.php";
                include "uhrzeit-lauftext.php";
            }
            // Tennisschuhe-Erinnerung im Mai-Juli Sonntags zwischen 08:00 und 08:45
            else if ($dayOfWeek == 0 && ($hours == 8 && $minutes >= 0 && $minutes <= 45) && ($month >= 5 && $month <= 7)) {
                include "platzreservierung.html";
                include "tennisschuhe.html";
                include "uhrzeit-lauftext.php";
                include "meisterschaft-wetter.html";
            }
            // Normaler Modus
            else {
                include "pdf-homepage.html";
                include "platzreservierung.html";
                include "uhrzeit-lauftext.php";
                include "meisterschaft-wetter.html";
            }

        ?>
    </div>
</body>
</html>
