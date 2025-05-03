<div class="row row-rand" id="row-unten">
    <div class="col-4 p-2 ps-3">            
        <div class="container-fluid h-100 bg-danger rounded-3">
            <div class="row h-100 d-flex align-items-center ps-2 pe-2 text-light">
                <div class="col p-0 h-100 text-start d-flex align-items-center">
                    <div class="container-fluid fs-1 fw-semibold" id="uhrzeit"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col p-2 pe-3">            
        <div class="container-fluid rounded-3 bg-danger d-flex align-items-center h-100 fs-1 fw-semibold text-light">
            <marquee scrollamount="10">Vorstands-Wochendienst:&nbsp;&nbsp;<span class="fs-1 fw-semibold" id="vorstand"><?php vorstandsdienst(); ?></span> <?php echo file_get_contents("../dateien/lauftext.txt"); ?></marquee>
        </div>
    </div>
</div>