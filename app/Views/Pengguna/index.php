<?= $this->extend('Layout/index'); ?>


<?= $this->section('content'); ?>

<!--begin::Card-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Card Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold fs-3 mb-1">Pengguna</span>
            <span class="text-muted mt-1 fw-semibold fs-7">Data Pengguna</span>
        </h3>
        <div class="card-toolbar">
            <button class="btn btn-sm btn-light-primary" data-bs-toggle="modal" data-bs-target="#modalPengguna">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1"
                            transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                    </svg>
                </span>
                <!--end::Svg Icon-->Tambah Pengguna</button>
        </div>
    </div>
    <!--end::Card Header-->
    <!--begin::Card Body-->
    <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive">
            <!--begin::Table-->
            <?php include('Table/tablePengguna.php'); ?>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--end::Card Body-->
</div>
<!--end::Card-->
<!-- begin::modalPengguna -->
<?php include('Modal/modalPengguna.php'); ?>
<!-- end::modalPengguna -->
<!-- begin::Script -->
<script src="<?= base_url(); ?>/assets/ajax/ajaxPengguna.js"></script>
<!-- end::Script -->

<?= $this->endSection(); ?>