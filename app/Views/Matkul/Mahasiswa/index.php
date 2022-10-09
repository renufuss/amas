<?= $this->extend('Matkul/LayoutDetail/index'); ?>

<?= $this->section('boxBawah'); ?>

<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header cursor-pointer">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Mahasiswa</h3>
                </div>
                <!--end::Card title-->
                <div class="card-toolbar">
            <!-- begin::Export Excel -->
            <button class="btn btn-sm btn-light-success m-3" data-bs-toggle="modal" data-bs-target="#modalPengguna">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                <i class="las la-file-csv la-2x"></i>
                </span>
                <!--end::Svg Icon-->Export Excel
            </button>
            <!-- end::Export Excel -->
        </div>
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
               <div id="table-mahasiswa"></div>
            </div>
            <!--end::Card body-->
        </div>
<script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>

<script>
    $(document).ready(function () {
        tableMahasiswa('<?= $matkul->id;?>');
    });
</script>
<?= $this->endSection(); ?>