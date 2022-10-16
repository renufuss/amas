<!-- begin :: DataTable CSS -->
<link href="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
<!-- end :: DataTable CSS -->

<input type="text" data-kt-docs-table-filter="search" class="form-control form-control-solid w-250px ps-15 mb-5" placeholder="Cari Agenda" id="search">


<table class="table align-middle gs-0 gy-4" id="dataTableAgenda">
    <!--begin::Table head-->
    <thead>
        <tr class="fw-bold text-muted bg-light">
            <th class="text-center rounded-start desktop-only ps-4">#</th>
            <th class="ps-4 min-w-200px text-center">Agenda</th>
            <th class="ps-4 min-w-100px desktop-only">Jam Masuk</th>
            <th class="ps-4 min-w-100px desktop-only">Jam Telat</th>
            <th class="ps-4 min-w-100px desktop-only">Jam Selesai</th>
            <th class="text-center rounded-end"></th>
        </tr>
    </thead>
    <tbody>
    <?php $i = 1;?>
        <tr>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
        </tr>
    </tbody>

    </table>

<!-- begin :: DataTable Js -->
<script src="<?= base_url(); ?>/assets/plugins/custom/datatables/datatables.bundle.js"></script>
<!-- end :: End DataTable Js -->

<script>
    $(document).ready(function () {
        const table = $('#dataTableAgenda').DataTable({
            "aaSorting": [],
            "scrollX": true
        });

        $('#search').on('keyup', function () {
            table.search(this.value).draw();
        });
    });
</script>