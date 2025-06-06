<!DOCTYPE html>
<html>
<head>
    <title>Infoscreen-Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-dark text-light">
    <?php /*error_reporting(0);*/ ?>
    <div class="container-fluid">
        <h1>Infoscreen-Administration</h1>
        <p class="bg-warning p-3 rounded-3 text-dark">NEU: Der Infoscreen wird nach spätestens 1 Minute neu geladen, nachdem eine Konfiguration hier geändert wurde!</p>
        <p class="bg-warning p-3 rounded-3 text-dark">Bitte beim Eintragen in die Textfelder darauf achten, dass keine unnötigen Leerzeichen, Leerzeilen, etc. vorhanden sind. Ich weiß nicht, was dann passieren wird, ich hab es nie getestet und will es auch nicht testen.</p>
        <div class="row">
            <div class="col">
                <form action="artikel.php" method="post">
                    <div class="row">
                        <h2 data-bs-toggle="collapse" data-bs-target=".artikel-collapse">&#11208; Homepage-Artikel</h2>
                        <div class="col-2 pe-0 text-center collapse artikel-collapse">
                            <h5>Dauer</h5>
                            <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-start" name="artikel-dauer" rows="10" placeholder="Sekunden"><?php echo file_get_contents("../../dateien/artikel_dauer.txt"); ?></textarea>
                        </div>
                        <div class="col ps-0 text-center collapse artikel-collapse">
                            <h5>Links <span class="fs-6 fw-semibold text-danger">("http://" bzw. https:// muss dabei sein!")</span></h5>
                            <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-end" name="artikel-links" rows="10" placeholder='URL inkl. "http"/"https"'><?php echo file_get_contents("../../dateien/artikel.txt"); ?></textarea>
                        </div>
                    </div>
                    <div class="row collapse artikel-collapse">
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary mt-2">Artikel einstellen</button>
                        </div>
                    </div>
                </form>
                <div class="row mt-4">
                    <h2 data-bs-toggle="collapse" data-bs-target=".praesentationsmodus-collapse">&#11208; Präsentations-Modus</h2>
                    <p class="text-danger fw-semibold collapse praesentationsmodus-collapse">Wenn nur die Platzreservierung unten und eine PDF oben angezeigt werden soll, den Dateinamen hier eintragen. Ist das Feld leer, wird der Infoscreen wie üblich angezeigt. Bis der gewählte Modus übernommen wird, dauert es max. 10 Minuten.</p>
                    <p class="text-danger fw-semibold collapse praesentationsmodus-collapse">Falls die PDF mehrere Seiten hat: Alle 20 Sekunden wird die nächste Seite angezeigt.</p>
                    <div class="col collapse praesentationsmodus-collapse">
                        <form action="praesentationsmodus.php" method="post">
                        <div class="form-group">
                            <label for="praesentationsmodus">Name der Datei, die angezeigt werden soll:</label>
                            <input type="text" class="form-control bg-secondary border border-dark" id="praesentationsmodus" name="praesentationsmodus" value='<?php echo file_get_contents("../../dateien/praesentationsmodus.txt"); ?>'>
                        </div>
                        <div class="form-group mt-2">
                            <label for="praesentationsmodus-seiten">Die ersten [x] Seiten sollen angezeigt werden:</label>
                            <input type="number" class="form-control bg-secondary border border-dark" id="praesentationsmodus-seiten" name="praesentationsmodus-seiten" min=1 value=<?php echo file_get_contents("../../dateien/praesentationsmodus_seiten.txt"); ?>>
                        </div>
                        <button type="submit" class="form-control btn btn-primary mt-3">Präsentationsmodus ändern</button>
                        </form>
                    </div>
                </div>
                <form action="vorstandsdienst.php" method="post">
                    <div class="row mt-4">
                        <h2 data-bs-toggle="collapse" data-bs-target=".vorstandsdienst-collapse">&#11208; Vorstandsdienst</h2>
                        <div class="col-2 pe-0 text-center collapse vorstandsdienst-collapse">
                            <h5>Woche</h5>
                            <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-start" name="vorstandsdienst-wochen" rows="26" placeholder="KW xx" readonly><?php echo file_get_contents("../../dateien/vorstandsdienst_wochen.txt"); ?></textarea>
                        </div>
                        <div class="col ps-0 text-center collapse vorstandsdienst-collapse">
                            <h5>Name</h5>
                            <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-end" name="vorstandsdienst-namen" rows="26" placeholder='Riepl Jan&#10;Mayer Marko&#10;etc.'><?php echo file_get_contents("../../dateien/vorstandsdienst_namen.txt"); ?></textarea>
                        </div>
                    </div>
                    <div class="row collapse vorstandsdienst-collapse">
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary mt-2">Vorstandsdienst einstellen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <h2 data-bs-toggle="collapse" data-bs-target=".pdf-collapse">&#11208; Ausschreibungen / PDFs</h2>
                <div class="row collapse pdf-collapse">
                    <div class="col">
                        <h4>PDF-Upload</h4>
                        <p class="fw-semibold text-danger">Idealerweise A4-Hochformat.</p>
                        <form action="datei_upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" class="form-control-file" name="datei" accept=".pdf">
                            <button type="submit" class="form-control btn btn-primary mt-2">Hochladen</button>
                        </form>
                    </div>
                    <div class="col">
                        <h4>Dateien löschen</h4>
                        <span>Bitte ankreuzen:</span>
                        <form action="datei_delete.php" method="post">
                            <?php
                                // Display all files in a directory
                                $dir = "../../dateien/";
                                $files = scandir($dir);
                                foreach ($files as $file) {
                                    if (pathinfo($file, PATHINFO_EXTENSION) == "pdf") {
                                        echo '<div class="checkbox"><label><input type="checkbox" name="filesToDelete[]" value="' . $file . '"> ' . $file . '</label></div>';
                                    }
                                }
                            ?>
                            <button type="submit" class="form-control btn btn-primary mt-2">Löschen</button>
                        </form>
                    </div>
                </div>
                <div class="row collapse pdf-collapse">
                    <div class="col">
                        <form action="pdfs.php" method="post">
                            <div class="row mt-4">
                                    <div class="col-2 pe-0 text-center">
                                        <h5>Dauer</h5>
                                        <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-start" name="pdfs-dauer" rows="10" placeholder="Sekunden"><?php echo file_get_contents("../../dateien/pdfs_dauer.txt"); ?></textarea>
                                    </div>
                                    <div class="col ps-0 text-center">
                                        <h5>Dateinamen</h5>
                                        <textarea class="form-control bg-secondary border border-dark rounded-0 rounded-end" name="pdfs-namen" rows="10" placeholder="Dateiname inkl. ".pdf""><?php echo file_get_contents("../../dateien/pdfs.txt"); ?></textarea>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="form-control btn btn-primary mt-2">PDFs einstellen</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row mt-4">
                    <h2 data-bs-toggle="collapse" data-bs-target=".lauftext-collapse">&#11208; Lauftext</h2>
                    <p class="text-danger fw-semibold collapse lauftext-collapse">Wichtig: Keine Zeilenumbrüche und mit '+++' anfangen und enden.</p>
                    <div class="col collapse lauftext-collapse">
                        <form action="lauftext.php" method="post">
                        <div class="form-group">
                            <textarea class="form-control bg-secondary border border-dark" id="lauftext" name="lauftext" rows="5" placeholder='Lauftext'><?php echo file_get_contents("../../dateien/lauftext.txt"); ?></textarea>
                            <button type="submit" class="form-control btn btn-primary mt-2">Lauftext ändern</button>
                        </div>
                        </form>
                    </div>
                </div>
                <form action="mannschaften.php" method="post">
                    <div class="row mt-4">
                        <h2 data-bs-toggle="collapse" data-bs-target=".mannschaften-collapse">&#11208; Meisterschafts-Mannschaften</h2>
                        <div class="col text-center collapse mannschaften-collapse">
                            <h5>Links <span class="fs-6 fw-semibold text-danger">(Die erste Hälfte der Links sind die Tabellen, die zweite Hälfte die der Mannschaftsseiten!)</span></h5>
                            <textarea class="form-control bg-secondary border border-dark rounded" name="mannschaften-links" rows="10" placeholder='URL inkl. "http"/"https"'><?php echo file_get_contents("../../dateien/mannschaften.txt"); ?></textarea>
                        </div>
                    </div>
                    <div class="row collapse mannschaften-collapse">
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary mt-2" disabled>Mannschaften einstellen (deaktiviert)</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
