<?= $this->extend('Matkul/LayoutDetail/index'); ?>

<?= $this->section('boxBawah'); ?>

<div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
            <!--begin::Card header-->
            <div class="card-header">
                <!--begin::Card title-->
                <div class="card-title m-0">
                    <h3 class="fw-bold m-0">Mahasiswa</h3>
                </div>
                <!--end::Card title-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body p-9">
               <div id="table-mahasiswa"></div>
            </div>
            <!--end::Card body-->
        </div>
<script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>

<script type="text/javascript">
    let idMatkul = <?= json_encode($matkul->id); ?>
</script>
<script>
    $(document).ready(function () {
        tableMahasiswa('<?= $matkul->id;?>');
    });
</script>
<?= $this->endSection(); ?>