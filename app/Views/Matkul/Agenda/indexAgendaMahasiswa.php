<?= $this->extend('Layout/index'); ?>


<?= $this->section('content'); ?>
<!--begin::Card-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Card Header-->
    <div class="card-header border-0 pt-5">
        <div class="d-flex align-items-center position-relative my-1 mb-2 mb-md-0">
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor"></rect>
                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor"></path>
                </svg>
            </span>
            <!--end::Svg Icon-->
            <input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15"
                placeholder="Cari Agenda" id="search">
        </div>
    </div>
    <!--end::Card Header-->
     <!--begin::Card Body-->
     <div class="card-body py-3">
        <!--begin::Table container-->
        <div class="table-responsive" id="table"></div>
        <!--end::Table container-->
    </div>
    <!--end::Card Body-->
</div>
<!--end::Card-->

<!-- begin::Script -->
<script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>
<!-- end::Script -->

<script>
    $(document).ready(function () {
        tableAgendaSaya()
    });
</script>

<?= $this->endSection(); ?>