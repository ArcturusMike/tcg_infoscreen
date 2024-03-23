function uhrzeit() {
    let wochentage = ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"];
    let monate = ["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"];

    let today = new Date();
    let wochentag = wochentage[today.getDay()];
    let tag = today.getDate();
    tag = checkTime(tag);
    let monat = monate[today.getMonth()]
    let date = tag + ". " + monat;

    let stunden = today.getHours();
    stunden = checkTime(stunden);
    let minuten = today.getMinutes();
    minuten = checkTime(minuten);
    let sekunden = today.getSeconds();
    sekunden = checkTime(sekunden);
    let time = stunden + ":" + minuten + "<span style='font-size: 16pt;'>:" + sekunden + "</span>";
    let dateTime = wochentag + ", " + date + ' &ndash; ' + time;

    document.getElementById("uhrzeit").innerHTML = dateTime;

    setTimeout(uhrzeit, 1000);
  }
  
function checkTime(i) {
    if (i < 10) {
        i = "0" + i;  // add zero in front of numbers < 10
    }
    return i;
}

function vorstandsdienst() {
    let vorstand = {
        19: "Rohrmeister Gerald",
        20: "Mayer Marko",
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
    const weekNumber = Math.ceil((daysUntilToday + januaryFirst.getDay()) / 7);

    let dienstname = vorstand[weekNumber];
    if (dienstname == undefined) {
        dienstname = "Riepl Jan";
    }


    document.getElementById("vorstand").innerHTML = dienstname;
}

function meisterschaftsRotation() {
    const tabellen = [
        "https://tennis-info-sigma.vercel.app/e/league/231720", 
        "https://tennis-info-sigma.vercel.app/e/league/231746", 
        "https://tennis-info-sigma.vercel.app/e/league/231861", 
        "https://tennis-info-sigma.vercel.app/e/league/231842"
    ];
    const spielplaene = [
        "https://tennis-info-sigma.vercel.app/e/team/532104", 
        "https://tennis-info-sigma.vercel.app/e/team/531968", 
        "https://tennis-info-sigma.vercel.app/e/team/532462", 
        "https://tennis-info-sigma.vercel.app/e/team/538002"
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
    const artikel = [
        "http://www.tcgoesselsdorf.at/", 
        "https://www.tcgoesselsdorf.at/termine/", 
        "https://www.tcgoesselsdorf.at/vereinsmeisterschaft-2023-infos/"
    ];
    const dauer = [
        30000, 
        20000, 
        10000
    ]; // in milliseconds

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
    const pdfs = [
        "mixed_1_2023.pdf", 
        "ul_diplom.pdf", 
        "tennisman.pdf"
    ];
    const dauer = [
        10000, 
        20000, 
        30000
    ]; // in milliseconds

    let index = 0;
    let delay = 0;

    function changePDFSources() {
        setTimeout(() => {
            delay = dauer[index];
            document.getElementById('pdf-iframe').src = "./" + pdfs[index] + "#toolbar=0&scrollbar=0&view=Fit";
            document.getElementById("pdfnummer").innerHTML = "(" + (index + 1) + "/" + pdfs.length + ")";
            index = (index + 1) % pdfs.length; // Increment index, looping back to 0 if necessary
            changePDFSources();
        }, delay);
    }

    changePDFSources();
}

function rotationen() {
    meisterschaftsRotation();
    homepageRotation();
    pdfRotation();
}

// Function to reload the page if the current time is xx:10, xx:20, xx:30, etc.
function seiteNeuladen() {
    const currentDate = new Date();
    const minutes = currentDate.getMinutes();
  
    if (minutes % 10 === 0) {
      window.location.reload(true);
    }
  }
  // Call the function every minute
  setInterval(seiteNeuladen, 60000);