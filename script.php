<?php
    function processFile($filePath) {
        // Check if the file exists
        if (file_exists($filePath)) {
            // Open the file for reading
            $file = fopen($filePath, "r");
            $lines = array();
    
            // Read the file line by line
            while (!feof($file)) {
                // Read the next line
                $line = fgets($file);
                // Trim whitespace from the beginning and end of the line
                $line = trim($line);
                // Check if the line is empty
                if (!empty($line)) {
                    // Check if the line is an integer
                    if (ctype_digit($line)) {
                        // Convert the line to integer and add it to the array
                        $lines[] = ((int)$line * 1000);
                    } else {
                        // If not an integer, add the line enclosed in double quotes
                        $lines[] = '"' . $line . '"';
                    }
                }
            }
    
            // Close the file
            fclose($file);
    
            // Echo the lines as a comma-separated string
            echo implode(', ', $lines);
        } else {
            // If the file doesn't exist, echo an error message
            echo "'The file does not exist.'";
        }
    }
?>

<script>
    // Lauftext laufen lassen falls Text zu lang
    function lauftextCheck() {
        const lauftext_width = document.getElementById("lauftext").scrollWidth;
        const parent_width = lauftext.parentElement.clientWidth;

        // Check if the content is wider than its container
        if (lauftext_width > parent_width) {
            let dauer = lauftext_width / 50;

            document.getElementById("lauftext").animate(
                [
                    {transform: "translateX(" + parent_width + "px)"},                              // from
                    {transform: "translateX(" + (-1 * lauftext_width) + "px)"}      // to
                ],
                {
                    duration: (dauer * 1000),
                    iterations: Infinity
                }
            );
        } else {
            lauftext.style.animation = "none"; // No animation if text fits
        }
    }

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
  
    function vorstandsdienst() {
        let vorstand = {
            19: "Mayer Marko",
            20: "Rohrmeister Gerald",
            21: "Wernig Rene",
            22: "Riepl Jan",
            23: "Nachbar Patrick",
            24: "Stefan Christopher",
            25: "Rohrmeister Gerald",
            26: "Mayer Marko",
            27: "Wernig Rene",
            28: "Riepl Jan",
            29: "Nachbar Patrick",
            30: "Stefan Christopher",
            31: "Rohrmeister Gerald",
            32: "Mayer Marko",
            33: "Wernig Rene",
            34: "Riepl Jan",
            35: "Nachbar Patrick",
            36: "Stefan Christopher",
            37: "Mayer Marko",
            38: "Rohrmeister Gerald",
            39: "Wernig Rene",
            40: "Riepl Jan",
            41: "Nachbar Patrick",
            42: "Stefan Christopher",
        };

        const today = new Date();
        const januaryFirst = new Date(today.getFullYear(), 0, 1);
        const daysUntilToday = Math.floor((today - januaryFirst) / (24 * 60 * 60 * 1000)) + 1;
        const weekNumber = Math.ceil((daysUntilToday + januaryFirst.getDay() - 1) / 7);

        let dienstname = vorstand[weekNumber];
        if (dienstname === undefined) {
            dienstname = "nicht besetzt";
        }


        document.getElementById("vorstand").innerHTML = dienstname;

        lauftextCheck();
    }

    function meisterschaftsRotation() {
        const tabellen = [
            "https://tennis-info-sigma.vercel.app/e/league/253681",
            "https://tennis-info-sigma.vercel.app/e/league/250966", 
            "https://tennis-info-sigma.vercel.app/e/league/250983", 
            "https://tennis-info-sigma.vercel.app/e/league/250989", 
            "https://tennis-info-sigma.vercel.app/e/league/251091"
        ];
        const spielplaene = [
            "https://tennis-info-sigma.vercel.app/e/team/585381",
            "https://tennis-info-sigma.vercel.app/e/team/571937", 
            "https://tennis-info-sigma.vercel.app/e/team/572237", 
            "https://tennis-info-sigma.vercel.app/e/team/577606", 
            "https://tennis-info-sigma.vercel.app/e/team/577605"
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
            document.getElementById("praesentations-container").innerHTML = '<iframe id="iframe-praesentation" class="w-100 h-100 rounded-3" src="../dateien/' + <?php echo '"' . file_get_contents("../dateien/praesentationsmodus.txt") . '"' ?> + '#toolbar=0&scrollbar=0&view=Fit&page=' + currentPage + '" scrolling="no"></iframe>';
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
</script>