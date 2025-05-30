<?php
    /*
    Es werden alle Config-Dateien nach der jüngsten mtime geprüft. 
    Diese gibt an, wann die Datei zuletzt bearbeitet wurde. 
    Die jüngste mtime wird in $latest gespeichert.
    */

    // check-config-mtime.php
    $dir = '../dateien';  // Adjust path to 'dateien'
    $latest = 0;

    // Load all .txt files in the directory
    foreach (glob($dir . '/*.txt') as $file) {
        $mtime = filemtime($file);
        if ($mtime > $latest) {
            $latest = $mtime;
        }
    }

    // Output the latest modified time
    echo $latest;
?>