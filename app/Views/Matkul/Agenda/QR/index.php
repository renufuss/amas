<?= $this->extend('Layout/index'); ?>


<?= $this->section('content'); ?>

<div class="row">
    <!-- QR -->
    <div class="col-lg-6 col-12">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">QR Code | <?= $agenda->name; ?></h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card Body-->
            <div class="card-body py-3">
                <img src="<?= base_url(); ?>/assets/qr/<?= $agenda->qr; ?>" width="100%"
                    alt="QR Code <?= $agenda->name; ?>">
            </div>
            <!--end::Card Body-->
        </div>
        <!--end::Card-->
    </div>

    <!-- Hadir -->
    <div class="col-lg-6 col-12">
        <!-- Hadir -->
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Hadir</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card Body-->
            <div class="card-body py-3" id="hadir">
            </div>
            <!--end::Card Body-->

        </div>
        <!--end::Card-->

        <!-- Terlambat -->
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Terlambat</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card Body-->
            <div class="card-body py-3" id="terlambat">
            </div>
            <!--end::Card Body-->

        </div>
        <!--end::Card-->
    </div>

    <!-- Izin -->
    <div class="col-lg-12 col-12">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Izin</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card Body-->
            <div class="card-body py-3" id="izin">
            </div>
            <!--end::Card Body-->

        </div>
        <!--end::Card-->
    </div>

    <!-- Belum Absen -->
    <div class="col-lg-12 col-12">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Belum Absen</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card Body-->
            <div class="card-body py-3" id="belumAbsen">
            </div>
            <!--end::Card Body-->

        </div>
        <!--end::Card-->
    </div>

</div>
</div>

<script type="text/javascript">
    let id = <?= json_encode($agenda->id); ?>
</script>
<script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>

<script>
    $(document).ready(function () {
        statusPresent();
    });
</script>

<?= $this->endSection(); ?>