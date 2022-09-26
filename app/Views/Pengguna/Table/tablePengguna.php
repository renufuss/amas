<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
<!-- end :: DataTable CSS -->

<table class="table align-middle gs-0 gy-4" id="dataTablePengguna">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start ps-4">#</th>
            <th class="ps-4 min-w-200px">Pengguna</th>
            <th class="ps-4 min-w-200px desktop-only">Nama Depan</th>
            <th class="ps-4 min-w-200px desktop-only">Nama Belakang</th>
            <th class="ps-4 min-w-100px desktop-only">Role</th>
            <th class="text-end rounded-end"></th>
        </tr>
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody>
        <?php $i = 1;
foreach($pengguna as $row) :
    ?>
        <tr>
            <td class="text-center">
                <?= $i++; ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <img src="assets/media/stock/600x400/img-26.jpg" class="" alt="" />
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->username)); ?></a>
                        <span class="text-muted fw-semibold text-muted d-block fs-7"><?= ucwords(strtolower($row->email)); ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->first_name; ?></td>
            <td class="desktop-only"><?= $row->last_name; ?></td>
            <td class="desktop-only">
                <span class="badge badge-light-danger fs-7 fw-bold">Admin</span>
            </td>
            <td class="text-end">
                <div class="me-0">
                    <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary"
                        data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="bi bi-three-dots fs-3"></i>
                    </button>
                    <!--begin::Menu 3-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-100px py-3"
                        data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Detail</a>
                        </div>
                        <!--end::Menu item-->
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Delete</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 3-->
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
    <!--end::Table body-->
</table>

<!-- begin :: DataTable Js -->
<script src="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!-- end :: End DataTable Js -->
<script>
    $(document).ready(function () {
    const table = $('#dataTablePengguna').DataTable();

    $('#search').on('keyup', function () {
    table.search( this.value ).draw();
    } );
    });        
</script>

