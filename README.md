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
9. Unclutter-Autostart einrichten ([Link](https://ostechnix.com/auto-hide-mouse-pointer-using-unclutter-after-a-certain-time/))
10. Browser Autostart: 
    - `crontab -e` und dort:
    - `@reboot sleep 10 && DISPLAY=:0 chromium-browser --hide-crash-restore-bubble --start-fullscreen http://localhost/tcg_infoscreen/` (HDMI muss angeschlossen sein, damit es funktioniert!)
11. Damit es einen Ordner zum Löschen später gibt, das Repository manuell clonen:
    - `sudo git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/`
12. Git Autoclone zu jeder vollen Stunde:
    - `sudo crontab -e` und dort:
    - `0 * * * * rm -r /var/www/html/tcg_infoscreen/ && git clone https://github.com/ArcturusMike/tcg_infoscreen.git /var/www/html/tcg_infoscreen/ && service apache2 restart`
13. 4K beim Raspberry in der Raspi-Config aktivieren --> Welche Auflösung dann?
14. Via Screen Configuration das Bild drehen
- [ ] Automatische Software-Updates einrichten
- [ ] Bildschirm dunkel 22-06 Uhr via HDMI-CEC einstellen
- [ ] Täglicher Reboot zu gewisser Zeit?