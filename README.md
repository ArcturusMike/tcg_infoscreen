# TC Gösselsdorf Infoscreen
Der Infoscreen läuft auf einem Raspberry Pi und einem vertikalen Bildschirm.

## Raspberry Pi Einrichtung

1. Raspberry Pi OS Desktop (64-bit) installieren
2. `sudo apt update && sudo apt upgrade`
3. Auf X11 stellen und VNC aktivieren
4. Screen Blanking/Bildschirmlöschen in der Raspi-Config deaktivieren (Bildschirmschoner)
5. Notifications in den Leisteneinstellungen deaktivieren
6. Die CPU- & RAM-Widgets in die Leiste packen
7. Bei Chromium `Adblock` und `I don’t care about cookies` installieren
8. `sudo apt update && sudo apt install apache2 php8.2 unclutter git`
9. `sudo mkdir /var/www/html/dateien/ && sudo chmod -R 777 /var/www/html/dateien/`
10. `sudo cd /var/www/html/dateien/ && sudo touch artikel_dauer.txt artikel.txt pdfs_dauer.txt pdfs.txt praesentationsmodus.txt`
11. Unclutter-Autostart einrichten ([Link](https://ostechnix.com/auto-hide-mouse-pointer-using-unclutter-after-a-certain-time/))
12. Automatische Sicherheitsupdates aktivieren ([Link](https://www.elektronik-kompendium.de/sites/raspberry-pi/2002101.htm))
13. Täglicher Reboot: (Schaltet das vll. den Bildschirm ein?)
    - `sudo crontab -e` und dort hinzufügen:
    - `0 4 * * * /sbin/shutdown -r now`
14. Manuelles Start-Skript für Infoscreen [erstellen](https://askubuntu.com/questions/475081/how-to-create-a-launcher-to-execute-a-terminal-command)
15. Browser Autostart:
    - `crontab -e` und dort:
    - `@reboot sleep 10 && DISPLAY=:0 chromium-browser --hide-crash-restore-bubble --start-fullscreen http://localhost/tcg_infoscreen/` (HDMI muss angeschlossen sein, damit es funktioniert!)
16. Damit es einen Ordner zum Löschen später gibt, das Repository manuell clonen:
    - `sudo git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/`
17. Git Autoclone alle 10 Minuten einer Stunde, nur wenn Internetverbindung besteht:
    - `sudo crontab -e` und dort:
    - `5,15,25,35,45,55 6-21 * * * ping -c 1 www.orf.at && rm -r /var/www/html/tcg_infoscreen/ && git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/ && service apache2 restart`
18. 4K beim Raspberry in der Raspi-Config aktivieren
19.  Via Screen Configuration: Auflösung 3840x2160 und dann das Bild drehen
- [ ] Bildschirm dunkel 22-06 Uhr via HDMI-CEC einstellen