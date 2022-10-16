<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet"
    type="text/css" />
<!-- end :: DataTable CSS -->




<table class="table align-middle gs-0 gy-4" id="dataTableAgendaMahasiswa">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px text-center">Agenda</th>
            <th class="ps-4 min-w-100px text-center desktop-only">Jam Masuk</th>
            <th class="ps-4 min-w-100px text-center desktop-only">Jam Telat</th>
            <th class="ps-4 min-w-100px text-center desktop-only">Jam Selesai</th>
            <th class="rounded-end"></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;
foreach($agenda as $row) :
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
                        <a href="#" class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row->name)) ?></a>
                        <span class="text-muted fw-semibold text-muted d-block fs-7"><?= strtoupper($row->nama); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-8 desktop-only"><?= strtoupper($row->kode); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-8 desktop-only"><?= strtoupper($row->kelas); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-8 mobile-only">Masuk : <?= $row->jam_masuk; ?></span>
                        <span class="text-muted fw-semibold text-muted fs-8 mobile-only">Telat : <?= $row->jam_telat; ?></span>
                        <span class="text-muted fw-semibold text-muted fs-8 mobile-only">Selesai : <?= $row->jam_selesai; ?></span>
                    </div>
                </div>
            </td>
            <td class="text-center desktop-only">
                <?= $row->jam_masuk; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $row->jam_telat; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $row->jam_selesai; ?>
            </td>
            <?php if(date('Y-m-d H:i:s') <= $row->jam_selesai) : ?>
            <td class="text-center">
                <div class="d-flex justify-content-end flex-shrink-0">
                    <!-- QR -->
                    <a href="<?= base_url(); ?>/matkul/qr/<?= $row->id; ?>"
                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                        <span class="svg-icon svg-icon-muted svg-icon-2hx">Izin
                        </span>
                    </a>
                </div>
            </td>
            <?php else: ?>
                <td class="text-center">
                -
                </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<!-- begin :: DataTable Js -->
<script src="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!-- end :: End DataTable Js -->

<script>
    $(document).ready(function () {
        const table = $('#dataTableAgendaMahasiswa').DataTable({
            "aaSorting": [],
            "scrollX": true
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>