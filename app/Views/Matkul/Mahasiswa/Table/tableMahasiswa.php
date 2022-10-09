<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!-- end :: DataTable CSS -->

<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15 mb-5" placeholder="Cari Mahasiswa" id="search">


<table class="table align-middle gs-0 gy-4" id="dataTableMahasiswa">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px">Mahasiswa</th>
            <th class="ps-4 min-w-100px desktop-only">NPM</th>
            <th class="text-center rounded-end"></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1;
foreach($mahasiswa as $row) :
    ?>
    <tr>
        <td class="text-center desktop-only">
            <?= $i++; ?>
        </td>
         <td>
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <?php if($row->image_profile != null) : ?>
                        <img src="<?= base_url(); ?>/assets/images/users/<?= $row->image_profile; ?>" class="" alt="" />
                        <?php else : ?>
                        <div class="symbol symbol-50px">
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row->badge; ?> text-inverse-danger"><?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->username)); ?></span>
                        <span class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row->email)); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row->npm; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->npm; ?></td>
            <td class="text-center">
                <div class="d-flex justify-content-end flex-shrink-0">
                    <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="deletePengguna('<?= $row->id;?>','<?= $row->username;?>')">
                        <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z"
                                    fill="currentColor"></path>
                                <path opacity="0.5"
                                    d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z"
                                    fill="currentColor"></path>
                                <path opacity="0.5"
                                    d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z"
                                    fill="currentColor"></path>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </td>
    </tr>
    <?php endforeach; ?>
    </tbody>

    </table>

<!-- begin :: DataTable Js -->
<script src="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!-- end :: End DataTable Js -->

<script>
    $(document).ready(function () {
        const table = $('#dataTableMahasiswa').DataTable({
            "aaSorting": [],
            "scrollX": true
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>