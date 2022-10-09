<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!-- end :: DataTable CSS -->


<table class="table align-middle gs-0 gy-4" id="datamatkul">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px">Mata Kuliah</th>
            <th class="ps-4 min-w-150px desktop-only text-center">Dosen</th>
            <th class="text-center rounded-end"></th>
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
                        <span class="text-muted fw-semibold text-muted fs-7"><?= strtoupper($row->kelas); ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only text-center"><?= ucwords(strtolower($row->first_name)); ?> <?= ucwords(strtolower($row->last_name)); ?></td>
            <td class="text-center">
                <button type="button" class="btn btn-bg-light btn-color-muted btn-active-color-primary btn-sm px-4 me-2" onclick="joinMatkul('<?= $row->id ?>','<?= $row->nama ?>')">Bergabung</button>
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
        const table = $('#datamatkul').DataTable({
            "aaSorting": [],
            "scrollX": true
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>