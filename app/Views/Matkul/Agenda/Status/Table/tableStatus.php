<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
    type="text/css" />
<!-- end :: DataTable CSS -->


<table class="table align-middle gs-0 gy-4" id="dataTableMahasiswa">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px">Mahasiswa</th>
            <th class="ps-4 min-w-100px desktop-only">NPM</th>
            <th class="text-center rounded-end">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
          <!-- belum absen -->
        <?php  foreach($belum_absen as $row) : ?>
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
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row->badge; ?> text-inverse-danger">
                                <?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->first_name)); ?>
                            <?= ucwords(strtolower($row->last_name)); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row->email)); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row->npm; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->npm; ?></td>
            <td class="text-center">
                <span class="badge badge-secondary fs-7 fw-bold">Belum Absen</span>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- Telat -->
        <?php  foreach($terlambat as $row) : ?>
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
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row->badge; ?> text-inverse-danger">
                                <?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->first_name)); ?>
                            <?= ucwords(strtolower($row->last_name)); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row->email)); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row->npm; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->npm; ?></td>
            <td class="text-center">
                <span class="badge badge-light-warning fs-7 fw-bold">Terlambat</span>
            </td>
        </tr>
        <?php endforeach; ?>
         <!-- Izin -->
         <?php  foreach($izin as $row) : ?>
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
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row->badge; ?> text-inverse-danger">
                                <?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->first_name)); ?>
                            <?= ucwords(strtolower($row->last_name)); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row->email)); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row->npm; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->npm; ?></td>
            <td class="text-center">
                <span class="badge badge-light-primary fs-7 fw-bold">Izin</span>
            </td>
        </tr>
        <?php endforeach; ?>
        <!-- hadir -->
        <?php  foreach($hadir as $row) : ?>
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
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row->badge; ?> text-inverse-danger">
                                <?= strtoupper(substr($row->first_name, 0, 1)); ?><?= strtoupper(substr($row->last_name, 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->first_name)); ?>
                            <?= ucwords(strtolower($row->last_name)); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row->email)); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row->npm; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row->npm; ?></td>
            <td class="text-center">
                <span class="badge badge-light-success fs-7 fw-bold">Hadir</span>
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