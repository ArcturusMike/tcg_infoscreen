<!DOCTYPE html>
<html>
<head>
    <title>Infoscreen-Admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">
        <h1>Infoscreen-Administration</h1>
        <p class="bg-warning p-3 rounded-3">Bitte beim Eintragen in die Textfelder darauf achten, dass keine unnötigen Leerzeichen, Leerzeilen, etc. vorhanden sind. Ich weiß nicht, was dann passieren wird, ich hab es nie getestet.</p>
        <div class="row">
            <div class="col">
                <form action="artikel.php" method="post">
                    <div class="row">
                        <h2>Homepage-Artikel</h2>
                            <div class="col-2 pe-0 text-center">
                                <h5>Dauer</h5>
                                <textarea class="form-control" name="artikel-dauer" rows="10" placeholder="Sekunden"><?php echo file_get_contents("../../dateien/artikel_dauer.txt"); ?></textarea>
                            </div>
                            <div class="col ps-0 text-center">
                                <h5>Links <span class="fs-6 fw-semibold text-danger">("http://" bzw. https:// muss dabei sein!")</span></h5>
                                <textarea class="form-control" name="artikel-links" rows="10" placeholder='URL inkl. "http"/"https"'><?php echo file_get_contents("../../dateien/artikel.txt"); ?></textarea>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary mt-2">Artikel einstellen</button>
                        </div>
                    </div>
                </form>
                <div class="row mt-4">
                    <h2>Präsentations-Modus</h2>
                    <p class="text-danger fw-semibold">Wenn nur die Platzreservierung unten und eine PDF oben angezeigt werden soll, den Dateinamen hier eintragen. Ist das Feld leer, wird der Infoscreen wie üblich angezeigt. Bis der gewählte Modus übernommen wird, dauert es max. 10 Minuten.</p>
                    <p class="text-danger fw-semibold">Nur Seite 1 wird angezeigt! (Falls die PDF mehrere Seiten hat)</p>
                    <div class="col">
                        <form action="praesentationsmodus.php" method="post">
                        <div class="form-group">
                            <label for="praesentationsmodus">Name:</label>
                            <input type="text" class="form-control" id="praesentationsmodus" name="praesentationsmodus" value='<?php echo file_get_contents("../../dateien/praesentationsmodus.txt"); ?>'>
                            <button type="submit" class="form-control btn btn-primary mt-2">Präsentationsmodus ändern</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <h2>Ausschreibungen / PDFs</h2>
                <div class="row">
                    <div class="col">
                        <h4>PDF-Upload</h4>
                        <p class="fw-semibold text-danger">Idealerweise A4-Hochformat.</p>
                        <form action="datei_upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" class="form-control-file" name="datei" accept=".pdf" multiple>
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
                <div class="row">
                    <div class="col">
                        <form action="pdfs.php" method="post">
                            <div class="row mt-4">
                                    <div class="col-2 pe-0 text-center">
                                        <h5>Dauer</h5>
                                        <textarea class="form-control" name="pdfs-dauer" rows="10" placeholder="Sekunden"><?php echo file_get_contents("../../dateien/pdfs_dauer.txt"); ?></textarea>
                                    </div>
                                    <div class="col ps-0 text-center">
                                        <h5>Dateinamen</h5>
                                        <textarea class="form-control" name="pdfs-namen" rows="10" placeholder="Dateiname inkl. ".pdf""><?php echo file_get_contents("../../dateien/pdfs.txt"); ?></textarea>
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
            </div>
        </div>
    </div>
</body>
</html>
