# TC Gösselsdorf Infoscreen
Der Infoscreen läuft auf einem Raspberry Pi und einem vertikal montierten Bildschirm.

## Raspberry Pi Einrichtung

1. Raspberry Pi OS Desktop (64-bit) installieren
2. `sudo apt update && sudo apt upgrade`
3. Auf X11 stellen, VNC aktivieren und mit meinem RealVNC-Konto verbinden ("lizensieren")
4. Screen Blanking/Bildschirmlöschen in der Raspi-Config deaktivieren (Bildschirmschoner)
5. Notifications in den Leisteneinstellungen deaktivieren
6. Die CPU- & RAM-Widgets in die Leiste packen
7. Bei Chromium `Adblock` und `I don’t care about cookies` installieren
8. `sudo apt update && sudo apt install apache2 php8.2 unclutter git`
9.  `sudo mkdir /var/www/html/dateien/ && cd /var/www/html/dateien/ && sudo touch artikel_dauer.txt artikel.txt pdfs_dauer.txt pdfs.txt praesentationsmodus.txt praesentationsmodus_seiten.txt lauftext.txt vorstandsdienst.txt && sudo chmod -R 777 /var/www/html/dateien/`
10. Unclutter-Autostart einrichten ([Link](https://ostechnix.com/auto-hide-mouse-pointer-using-unclutter-after-a-certain-time/))
11. ~~Automatische Sicherheitsupdates aktivieren ([Link](https://www.elektronik-kompendium.de/sites/raspberry-pi/2002101.htm))~~
12. ~~Täglicher Reboot: (Schaltet das vll. den Bildschirm ein?)~~
    - `sudo crontab -e` und dort hinzufügen:
    - `45 7 * * * /sbin/shutdown -r now`
13. 2 Mal am Tag Chromium neu starten:
    - `crontab -e` und dort hinzufügen:
    - `0 7,16 * * * pkill -9 chromium && DISPLAY=:0 chromium-browser --hide-crash-restore-bubble --start-fullscreen http://localhost/tcg_infoscreen/`
14. Manuelles Start-Skript für Infoscreen [erstellen](https://askubuntu.com/questions/475081/how-to-create-a-launcher-to-execute-a-terminal-command)
15. Browser Autostart:
    - `crontab -e` und dort:
    - `@reboot sleep 10 && DISPLAY=:0 chromium-browser --hide-crash-restore-bubble --start-fullscreen http://localhost/tcg_infoscreen/` (HDMI muss angeschlossen sein, damit es funktioniert!)
16. Damit es einen Ordner zum Löschen später gibt, das Repository manuell clonen:
    - `sudo git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/`
17. ~~Git Autoclone alle 10 Minuten einer Stunde, nur wenn Internetverbindung besteht:~~
    - `sudo crontab -e` und dort:
    - `9,19,29,39,49,59 6-21 * * * ping -c 1 www.orf.at && rm -r /var/www/html/tcg_infoscreen/ && git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/ && service apache2 restart`
18. 4K beim Raspberry in der Raspi-Config aktivieren
19.  Via Screen Configuration: Auflösung 3840x2160 und dann das Bild drehen
20. Bildschirm dunkel 22-06 Uhr via HDMI-CEC [einstellen](https://pimylifeup.com/raspberrypi-hdmi-cec/) und folgende crontabs einrichten:
    - `0 22 * * * echo 'standby 0.0.0.0' | /usr/bin/cec-client -s -d 1`
    - `0 8 * * * echo 'on 0.0.0.0' | /usr/bin/cec-client -s -d 1`

## To do:

- [ ] Statt das lange Kommando "chromium-browser..." an mehreren Stellen auszuführen, eine .sh-Datei erstellen und diese dann im crontab bzw. im Dekstop-Starter ausführen
- [ ] Vorstandsdienst konfigurierbar machen
- [ ] Anzeige, wie lange etwas noch zu sehen ist. Progress bar wie bei v1 oder progress circle.
- [ ] Bilder anzeigbar machen (Diashow)
- [ ] Tennis-Live-Ergebnisse einbinden (https://ls.sir.sportradar.com/tennisnet/de/tennis/atp geht vielleicht irgendwie)
- [ ] Lauftext: Marquee durch CSS-Animation ersetzen damit flüssig
- [ ] Meisterschaft Light Mode?
- [ ] Präsentationsmodus auf nur 1 Konfig-Datei umbauen
- [ ] Konfiguration erreichbar machen via Tailscale o.Ä.?