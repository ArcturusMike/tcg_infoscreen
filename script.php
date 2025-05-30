<?php
    function processFile($filePath, $mode = 0) {
        // Check if the file exists
        if (file_exists($filePath)) {
            // Read all lines into an array
            $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
            // Count total lines
            $totalLines = count($lines);
            $halfIndex = ceil($totalLines / 2); // Determine halfway point
    
            // Determine which lines to process based on $mode
            if ($mode == 1) {
                $lines = array_slice($lines, 0, $halfIndex); // First half
            } elseif ($mode == 2) {
                $lines = array_slice($lines, $halfIndex); // Second half
            }
    
            $processedLines = array();
    
            // Process each line
            foreach ($lines as $line) {
                $line = trim($line);
    
                if (!empty($line)) {
                    if (ctype_digit($line)) {
                        $processedLines[] = ((int)$line * 1000);
                    } else {
                        $processedLines[] = '"' . $line . '"';
                    }
                }
            }
    
            // Echo the processed lines as a comma-separated string
            echo implode(', ', $processedLines);
        } else {
            // If the file doesn't exist, echo an error message
            echo "'The file does not exist.'";
        }
    }

    function vorstandsdienst() {
        // Get the current week number
        $currentWeek = date('W');  // Get current week number (1-52)
        
        // Path to the file containing the week numbers
        $weekFile = '../dateien/vorstandsdienst_wochen.txt';
    
        // Check if the file exists
        if (!file_exists($weekFile)) {
            return "Datei '$weekFile' existiert nicht.";
        }
    
        // Read the lines from 'vorstandsdienst_wochen.txt'
        $weekLines = file($weekFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        // Check if the current week is in the list and get its line number
        $weekLine = null;
        foreach ($weekLines as $index => $line) {
            if (strpos($line, $currentWeek) !== false) {
                // Found the current week in the line, get its line number
                $weekLine = $index + 1;  // Line number (starting from 1)
                break;
            }
        }
    
        // If week number is not found, echo "nicht besetzt"
        if ($weekLine === null) {
            return "nicht besetzt";
        }
    
        // Path to the file that contains the names (e.g. vorstandsdienst_namen.txt)
        $nameFile = '../dateien/vorstandsdienst_namen.txt';
    
        // Check if the name file exists
        if (!file_exists($nameFile)) {
            return "Datei '$nameFile' existiert nicht.";
        }
    
        // Read the lines from the name file
        $nameLines = file($nameFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
        // Check if the file has enough lines for the current week's line number
        if (isset($nameLines[$weekLine - 1])) {
            // Get the content of the line with the corresponding week number
            $dienstname = $nameLines[$weekLine - 1];
            // Echo the dienstname
            return $dienstname;
        } else {
            return "Kein Eintrag für Woche $currentWeek in '$nameFile'.";
        }
    }
    
?>

<script>
    function uhrzeit() {
        let wochentage = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];
        //let monate = ["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"];
        let monate = ["Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"];
        //let monate = ["01","02","03","04","05","06","07","08","09","10","11","12"];

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i;  // add zero in front of numbers < 10
            }
            return i;
        }

        let today = new Date();
        let wochentag = wochentage[today.getDay()];
        let tag = today.getDate();
        tag = checkTime(tag);
        let monat = monate[today.getMonth()]
        let date = tag + ". " + monat + ".";

        let stunden = today.getHours();
        stunden = checkTime(stunden);
        let minuten = today.getMinutes();
        minuten = checkTime(minuten);
        let sekunden = today.getSeconds();
        sekunden = checkTime(sekunden);
        let time = stunden + ":" + minuten + "<span style='font-size: 16pt;'>:" + sekunden + "</span>";
        let dateTime = wochentag + ", " + date + '&nbsp;&nbsp;&ndash;&nbsp;&nbsp;' + time;

        document.getElementById("uhrzeit").innerHTML = dateTime;

        setTimeout(uhrzeit, 1000);
    }

    function meisterschaftsRotation() {
        const tabellen = [
            <?php processFile('../dateien/mannschaften.txt', 1); ?>
        ];
        const spielplaene = [
            <?php processFile('../dateien/mannschaften.txt', 2); ?>
        ];

        let index = 0;

        function ChangeTeamSources() {
            document.getElementById('tabelle-iframe').src = tabellen[index];
            document.getElementById('spielplan-iframe').src = spielplaene[index];
            document.getElementById("mannschaftsnummer").innerHTML = "(" + (index + 1) + "/" + tabellen.length + ")";
            index = (index + 1) % tabellen.length; // Wrap around the index
        }

        ChangeTeamSources();
        setInterval(ChangeTeamSources, 30000); // Swap every 30 seconds
    }

    function homepageRotation() {
        const artikel = [<?php processFile('../dateien/artikel.txt'); ?>];
        const dauer = [<?php processFile('../dateien/artikel_dauer.txt'); ?>]; // in milliseconds

        let index = 0;
        let delay = 0;

        function changeHomepageSources() {
            setTimeout(() => {
                delay = dauer[index];
                document.getElementById('homepage-iframe').src = artikel[index] + "#primary";
                document.getElementById("artikelnummer").innerHTML = "(" + (index + 1) + "/" + artikel.length + ")";
                index = (index + 1) % artikel.length; // Increment index, looping back to 0 if necessary
                changeHomepageSources();
            }, delay);
        }

        changeHomepageSources();
    }

    function pdfRotation() {
        const pdfs = [<?php processFile('../dateien/pdfs.txt'); ?>];
        const dauer = [<?php processFile('../dateien/pdfs_dauer.txt'); ?>]; // in milliseconds

        let index = 0;
        let delay = 0;

        function changePDFSources() {
            setTimeout(() => {
                delay = dauer[index];
                document.getElementById('pdf-iframe').src = "../dateien/" + pdfs[index] + "#toolbar=0&scrollbar=0&view=Fit";
                document.getElementById("pdfnummer").innerHTML = "(" + (index + 1) + "/" + pdfs.length + ")";
                index = (index + 1) % pdfs.length; // Increment index, looping back to 0 if necessary
                changePDFSources();
            }, delay);
        }

        changePDFSources();
    }

    function praesentation_seitenwechsel() {
        let rotationInterval = 20000; // Interval in milliseconds
        let currentPage = 1;
        let totalPages = <?php echo intval(file_get_contents("../dateien/praesentationsmodus_seiten.txt")); ?>;

        function rotatePages() {
            currentPage = (currentPage % totalPages) + 1;
            document.getElementById("praesentations-container").innerHTML = '<iframe id="praesentation-iframe" class="w-100 h-100 rounded-3" src="../dateien/' + <?php echo '"' . file_get_contents("../dateien/praesentationsmodus.txt") . '"' ?> + '#toolbar=0&scrollbar=0&view=Fit&page=' + currentPage + '" scrolling="no"></iframe>';
        }

        if (totalPages > 1) {
            setInterval(rotatePages, rotationInterval);
        }
    }

    function rotationen() {
        <?php
            if (file_get_contents("../dateien/praesentationsmodus.txt") == "") {
                echo "meisterschaftsRotation(); homepageRotation(); pdfRotation();";
            }
            else {
                echo "praesentation_seitenwechsel();";
            }
        ?>
    }

    /*
    // Seite neu laden: Mo-Fr um xx:10, xx:20, ...; Sa-So um xx:05, xx:10, ...
    function seiteNeuladen() {
        const currentDate = new Date();
        const day = currentDate.getDay(); // 0 = Sunday, 6 = Saturday
        const minutes = currentDate.getMinutes();

        if ((day === 0 || day === 6) && minutes % 5 === 0) {
            // Reload every 5 minutes on weekends (Saturday & Sunday)
            window.location.reload(true);
        } else if (day >= 1 && day <= 5 && minutes % 10 === 0) {
            // Reload every 10 minutes from Monday to Friday
            window.location.reload(true);
        }
    }
    // Call the function every minute
    setInterval(seiteNeuladen, 60000);
    */

   // Seite neu laden, wenn es eine jüngere mtime als die gespeicherte gibt oder sonst alle 3 Stunden.
   let lastKnownTime = 0;
    function seiteNeuLaden() {
        fetch('config-mtime-check.php?ts=' + Date.now())
            .then(res => res.text())
            .then(mtime => {
                const serverTime = parseInt(mtime, 10);
                if (!lastKnownTime) {
                    lastKnownTime = serverTime;  // First run
                } else if (serverTime > lastKnownTime) {
                    location.reload();  // Reload if file changed
                }
            })
            .catch(err => console.error('Mtime-Check failed:', err));

            // wenn festgelegte Zeit
            const now = new Date();
            const hours = now.getHours();
            const minutes = now.getMinutes();

            const reloadTimes = [
                { h: 8, m: 30 },
                { h: 12, m: 30 },
                { h: 16, m: 30 },
                { h: 18, m: 30 }
            ];

            for (const t of reloadTimes) {
                if (hours === t.h && minutes === t.m) {
                    location.reload();
                    break;
                }
            }
    }
    setInterval(seiteNeuLaden, 60000); // Check every 60 seconds
</script>