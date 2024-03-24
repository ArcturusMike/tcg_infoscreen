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
                    <div class="form-group">
                        <div class="row">
                            <h2>Homepage-Artikel</h2>
                                <div class="col-2 pe-0 text-center">
                                    <h5>Dauer</h5>
                                    <textarea class="form-control" name="artikel-dauer" rows="10" placeholder="30"><?php echo file_get_contents("../artikel_dauer.txt"); ?></textarea>
                                </div>
                                <div class="col ps-0 text-center">
                                    <h5>Links (https://www........)</h5>
                                    <textarea class="form-control" name="artikel-links" rows="10" placeholder="https://www.tcgoesselsdorf.at"><?php echo file_get_contents("../artikel.txt"); ?></textarea>
                                </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <button type="submit" class="form-control btn btn-primary mt-2">Artikel einstellen</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col">
                <h2>PDF</h2>
            </div>
        </div>
    </div>
</body>
</html>
