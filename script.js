function uhrzeit() {
    let wochentage = ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"];
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
    let time = stunden + ":" + minuten + "<span style='font-size: 12pt;'>:" + sekunden + "</span>";
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