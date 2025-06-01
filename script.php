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

        // Lazy loading: Die iframe-Webseiten werden nacheinander alle geladen, aber gespeichert, damit sie nicht immer neu abgerufen werden müssen. Spart CPU.
        const tabelleWrapper = document.getElementById('tabelle-wrapper');
        const spielplanWrapper = document.getElementById('spielplan-wrapper');

        const tabelleIframes = new Array(tabellen.length).fill(null);
        const spielplanIframes = new Array(spielplaene.length).fill(null);

        function ChangeTeamSources() {
            // Hide all existing iframes
            tabelleIframes.forEach((iframe) => {
                if (iframe) iframe.style.display = 'none';
            });
            spielplanIframes.forEach((iframe) => {
                if (iframe) iframe.style.display = 'none';
            });

            // Load and display tabelle iframe
            if (!tabelleIframes[index]) {
                const tabI = document.createElement('iframe');
                tabI.className = 'tabelle-iframe rounded-bottom-3';
                tabI.setAttribute('scrolling', 'no');
                tabI.dataset.src = tabellen[index];
                tabI.src = tabellen[index];
                tabI.style.display = 'block';
                tabelleWrapper.appendChild(tabI);
                tabelleIframes[index] = tabI;
            } else {
                tabelleIframes[index].style.display = 'block';
            }

            // Load and display spielplan iframe
            if (!spielplanIframes[index]) {
                const spI = document.createElement('iframe');
                spI.className = 'spielplan-iframe rounded-bottom-3';
                spI.setAttribute('scrolling', 'no');
                spI.dataset.src = spielplaene[index];
                spI.src = spielplaene[index];
                spI.style.display = 'block';
                spielplanWrapper.appendChild(spI);
                spielplanIframes[index] = spI;
            } else {
                spielplanIframes[index].style.display = 'block';
            }

            // Update team index display
            document.getElementById("mannschaftsnummer").innerHTML = `(${index + 1}/${tabellen.length})`;

            // Move to next index
            index = (index + 1) % tabellen.length;
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

        // Lazy loading funktioniert leider so, dass das #primary beim zweiten mal Laden nicht mehr funktioniert.
        /*
        const homepageWrapper = document.getElementById('homepage-wrapper');
        const cachedHomepages = new Array(artikel.length).fill(null);

        let index = 0;

        function changeHomepageSources() {
            // Hide all existing iframes
            cachedHomepages.forEach((iframe) => {
                if (iframe) iframe.style.display = 'none';
            });

            // Lazy-load iframe if not already created
            if (!cachedHomepages[index]) {
                const iframe = document.createElement('iframe');
                iframe.className = 'homepage-iframe rounded-bottom-3';
                iframe.setAttribute('scrolling', 'no');
                iframe.dataset.src = artikel[index] + "#primary";
                iframe.src = iframe.dataset.src;
                iframe.style.display = 'block';
                homepageWrapper.appendChild(iframe);
                cachedHomepages[index] = iframe;
            } else {
                cachedHomepages[index].style.display = 'block';
            }

            // Update current index display
            document.getElementById("artikelnummer").innerHTML = `(${index + 1}/${artikel.length})`;

            // Schedule next switch
            const delay = dauer[index];
            index = (index + 1) % artikel.length;
            setTimeout(changeHomepageSources, delay);
        }
        */

        changeHomepageSources();
    }

    function pdfRotation() {
        // Lazy loading wurde eingebaut, siehe meisterschaftsRotation().
        const pdfs = [<?php processFile('../dateien/pdfs.txt'); ?>];
        const dauer = [<?php processFile('../dateien/pdfs_dauer.txt'); ?>]; // in milliseconds

        const pdfWrapper = document.getElementById('pdf-wrapper');
        const cachedPDFs = new Array(pdfs.length).fill(null);

        let index = 0;

        function changePDFSources() {
            // Hide all cached iframes
            cachedPDFs.forEach((iframe) => {
                if (iframe) iframe.style.display = 'none';
            });

            // If not yet loaded, create and cache iframe
            if (!cachedPDFs[index]) {
                const iframe = document.createElement('iframe');
                iframe.className = 'pdf-iframe rounded-bottom-3';
                iframe.setAttribute('scrolling', 'no');
                iframe.dataset.src = "../dateien/" + pdfs[index] + "#toolbar=0&scrollbar=0&view=Fit";
                iframe.src = iframe.dataset.src;
                iframe.style.display = 'block';
                pdfWrapper.appendChild(iframe);
                cachedPDFs[index] = iframe;
            } else {
                // Show the already loaded iframe
                cachedPDFs[index].style.display = 'block';
            }

            // Update visible page number
            document.getElementById("pdfnummer").innerHTML = `(${index + 1}/${pdfs.length})`;

            // Schedule the next switch
            const delay = dauer[index];
            index = (index + 1) % pdfs.length;
            setTimeout(changePDFSources, delay);
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
                { h: 8, m: 50 },
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