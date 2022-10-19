<?= $this->extend('Matkul/LayoutDetail/index'); ?>

<?= $this->section('boxBawah'); ?>

<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Agenda</h3>
                </div>
                <!--end::Card title-->
                <div class="card-toolbar">
            <!-- begin::Export Excel -->
            <button class="btn btn-sm btn-light-primary m-3" data-bs-toggle="modal" data-bs-target="#modalAgenda">
                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                <span class="svg-icon svg-icon-2">
                <i class="las la-plus la-2x"></i>
                </span>
                <!--end::Svg Icon-->Tambah Agenda
            </button>
            <!-- end::Export Excel -->
        </div>
            </div>
            <!--begin::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
               <div id="table-agenda"></div>
            </div>
            <!--end::Card body-->
        </div>
        <!-- begin::modalAgenda -->
        <?php include('Modal/modalAgenda.php'); ?>
        <!-- end::modalAgenda -->
    <script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>

<script type="text/javascript">
    let idMatkul = <?= json_encode($matkul->id); ?>
</script>

<script>
    $(document).ready(function () {
        tableAgenda('<?= $matkul->id;?>');
    });
</script>
<?= $this->endSection(); ?>