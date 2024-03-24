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
        <div class="row">
            <div class="col">
                <form action="artikel.php" method="post">
                    <div class="row">
                        <h2>Homepage-Artikel</h2>
                            <div class="col-2 pe-0 text-center">
                                <h5>Dauer</h5>
                                <textarea class="form-control" name="artikel-dauer" rows="10" placeholder="Sekunden"><?php echo file_get_contents("../artikel_dauer.txt"); ?></textarea>
                            </div>
                            <div class="col ps-0 text-center">
                                <h5>Links (Wichtig: "http:// bzw. https:// muss dabei sein!")</h5>
                                <textarea class="form-control" name="artikel-links" rows="10" placeholder="URL inkl. http/https"><?php echo file_get_contents("../artikel.txt"); ?></textarea>
                            </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="submit" class="form-control btn btn-primary mt-2">Artikel einstellen</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <h2>Ausschreibungen / PDFs</h2>
                <div class="row">
                    <div class="col">
                        <h5>PDF-Upload</h5>
                        <form action="datei_upload.php" method="post" enctype="multipart/form-data">
                            <input type="file" class="form-control-file" name="datei" accept=".pdf, .jpg, .png" multiple>
                            <button type="submit" class="form-control btn btn-primary mt-2">Hochladen</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
