<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!-- end :: DataTable CSS -->


<table class="table align-middle gs-0 gy-4" id="dataTableMatkulSaya">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px">Mata Kuliah</th>
            <th class="ps-4 min-w-200px desktop-only">Kelas</th>
            <th class="rounded-end"></th>
        </tr>
    </thead>
    <!--end::Table head-->
    <!--begin::Table body-->
    <tbody>
        <?php $i = 1;
foreach($tampildata as $row) :
    ?>
        <tr>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td>
            <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <?php if($row->image != null) : ?>
                        <img src="<?= base_url(); ?>/assets/images/users/<?= $row->image; ?>" class="" alt="" />
                        <?php else : ?>
                            <?php
                            $bg = ['success', 'primary', 'warning', 'danger'];
                            $random = array_rand($bg, 1);
                            ?>
                        <div class="symbol symbol-50px">
                            <div class="symbol-label fs-2 fw-semibold bg-<?=  $bg[$random]; ?> text-inverse-danger"><?= strtoupper(substr($row->nama, 0, 1)); ?></div>
                        </div>
                        <?php endif; ?>
                    </div>
                <div class="d-flex align-items-center">
                    <div class="d-flex justify-content-start flex-column">
                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->nama)) ?></a>
                        <span class="text-muted fw-semibold text-muted d-block fs-7"><?= strtoupper($row->kode); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-7 mobile-only"><?= strtoupper($row->kelas); ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= strtoupper($row->kelas); ?></td>
            <td class="text-end">
                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="hapusJoin('<?= $row->id;?>','<?= $row->nama;?>')">
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
        const table = $('#dataTableMatkulSaya').DataTable({
            "aaSorting": [],
            "scrollX": true
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>