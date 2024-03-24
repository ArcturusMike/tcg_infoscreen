<!DOCTYPE html>
<html>
<head>
    <title>TCG Infoscreen</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <?php include "script.php"; ?>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body onload="uhrzeit(); vorstandsdienst(); rotationen();">
    <div class="container-fluid main-container">
        <div class="row row-rand" id="row-oben">
            <div class="col p-2 pt-3 ps-3 pe-3">            
                <div class="container-fluid h-100 bg-danger rounded-3">
                    <div class="row h-100 d-flex align-items-center ps-2 pe-2">
                        <div class="col p-0 h-100 text-start d-flex align-items-center">
                            <div class="container-fluid fs-1 fw-semibold" id="uhrzeit"></div>
                        </div>
                        <div class="col p-0 h-100 text-end d-flex align-items-center">
                            <div class="container-fluid fs-1 fw-semibold">
                                Vorstands-Wochendienst:&nbsp;&nbsp;<span class="fs-1 fw-normal" id="vorstand"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            if (file_get_contents("./praesentationsmodus.txt") == "") {
                include "obererteil_normal.html";
            }
            else {
                include "obererteil_praesentation.php";
            }
        ?>
        <div class="row row-mitte" id="row-platzreservierung">
            <div class="col p-2 ps-3 pe-3">
                <div class="container-fluid h-100 bg-success rounded-3">
                    <div class="row row-title rounded-3">
                        <div class="col p-0">
                            <div class="container-fluid h-100 d-flex align-items-center justify-content-center"><span class="fs-1">Reservierung Platz 4</span></div>
                        </div>
                    </div>
                    <div class="row row-iframe rounded-3">
                        <div class="col p-0">
                            <div class="container-fluid p-0 h-100"><iframe class="rounded-bottom-3" id="platzreservierung-iframe" src="https://goesselsdorf.tennisplatz.info/infoscreen/fa50be7dd32606f936ffd880c84a498c6f8cacb4?days=8&refresh=1" scrolling="no"></iframe></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row row-rand" id="row-unten">
            <div class="col p-2 pb-3 ps-3 pe-3">
                <div class="container-fluid rounded-3 bg-danger d-flex align-items-center h-100">
                    <span class="fs-1">Hier könnte Lauftext stehen bzw. der Bereich ist noch ideenlos.</span>
                </div>
            </div>
        </div>
    </div>
</body>
</html>