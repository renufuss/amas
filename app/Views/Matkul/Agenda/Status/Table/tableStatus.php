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
            <th class="ps-4 min-w-100px text-center">Status</th>
            <th class="ps-4 min-w-100px desktop-only">Keterangan</th>
            <th class="text-center rounded-end desktop-only"></th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1;?>
        <!-- menunggu persetujuan -->
        <?php  foreach($menunggu_persetujuan as $row) : ?>
        <tr>
            <td class="text-center desktop-only">
                <?= $i++; ?>
            </td>
            <td>
                <div class="d-flex align-items-center">
                    <div class="symbol symbol-50px me-5">
                        <?php if($row['image_profile'] != null) : ?>
                        <img src="<?= base_url(); ?>/assets/images/users/<?= $row['image_profile']; ?>" class=""
                            alt="" />
                        <?php else : ?>
                        <div class="symbol symbol-50px">
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row['badge']; ?> text-inverse-danger">
                                <?= strtoupper(substr($row['first_name'], 0, 1)); ?><?= strtoupper(substr($row['last_name'], 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row['first_name'])); ?>
                            <?= ucwords(strtolower($row['last_name'])); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row['email'])); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row['npm']; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row['npm']; ?></td>
            <td class="text-center">
                <span class="badge badge-secondary fs-7 fw-bold">Menunggu Persetujuan</span>
            </td>
            <td class="desktop-only">
                <?= $row['keterangan']; ?>
            </td>
            <td class="desktop-only">
                <a class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"
                    href="<?= base_url('assets/buktiIzin/' . $row['bukti']); ?>" target="_blank">
                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="-3 -3 30 30"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z"
                                fill="currentColor" />
                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                        </svg>
                    </span>
                </a>
                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="acceptIzin('<?= $row['idMahasiswaAgenda']; ?>')">
                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="-3 -3 30 30"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM11.7 17.7L16 14C16.4 13.6 16.4 12.9 16 12.5C15.6 12.1 15.4 12.6 15 13L11 16L9 15C8.6 14.6 8.4 14.1 8 14.5C7.6 14.9 8.1 15.6 8.5 16L10.3 17.7C10.5 17.9 10.8 18 11 18C11.2 18 11.5 17.9 11.7 17.7Z"
                                fill="currentColor" />
                            <path
                                d="M10.4343 15.4343L9.25 14.25C8.83579 13.8358 8.16421 13.8358 7.75 14.25C7.33579 14.6642 7.33579 15.3358 7.75 15.75L10.2929 18.2929C10.6834 18.6834 11.3166 18.6834 11.7071 18.2929L16.25 13.75C16.6642 13.3358 16.6642 12.6642 16.25 12.25C15.8358 11.8358 15.1642 11.8358 14.75 12.25L11.5657 15.4343C11.2533 15.7467 10.7467 15.7467 10.4343 15.4343Z"
                                fill="currentColor" />
                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                        </svg>
                    </span>
                </button>
                <button class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"  onclick="tolakIzin('<?= $row['idMahasiswaAgenda']; ?>')">
                    <span class="svg-icon svg-icon-muted svg-icon-2hx"><svg width="24" height="24" viewBox="-3 -3 30 30"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.3"
                                d="M5 22H19C19.6 22 20 21.6 20 21V8L14 2H5C4.4 2 4 2.4 4 3V21C4 21.6 4.4 22 5 22Z"
                                fill="currentColor" />
                            <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
                            <rect x="7.55518" y="16.7585" width="10.144" height="2" rx="1"
                                transform="rotate(-45 7.55518 16.7585)" fill="currentColor" />
                            <rect x="9.0174" y="9.60327" width="10.0952" height="2" rx="1"
                                transform="rotate(45 9.0174 9.60327)" fill="currentColor" />
                        </svg>
                    </span>
                </button>
            </td>
        </tr>
        <?php endforeach; ?>
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
                <span class="badge badge-light-danger fs-7 fw-bold">Belum Absen</span>
            </td>
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
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
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
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
                        <?php if($row['image_profile'] != null) : ?>
                        <img src="<?= base_url(); ?>/assets/images/users/<?= $row['image_profile']; ?>" class=""
                            alt="" />
                        <?php else : ?>
                        <div class="symbol symbol-50px">
                            <div class="symbol-label fs-2 fw-semibold bg-<?= $row['badge']; ?> text-inverse-danger">
                                <?= strtoupper(substr($row['first_name'], 0, 1)); ?><?= strtoupper(substr($row['last_name'], 0, 1)); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex justify-content-start flex-column">
                        <span
                            class="text-dark fw-bold text-hover-primary mb-1 fs-6"><?= ucwords(strtolower($row['first_name'])); ?>
                            <?= ucwords(strtolower($row['last_name'])); ?></span>
                        <span
                            class="text-muted fw-semibold text-muted d-block fs-8"><?= ucwords(strtolower($row['email'])); ?></span>
                        <span class="text-muted fw-semibold text-muted fs-9 mobile-only"><?= $row['npm']; ?></span>
                    </div>
                </div>
            </td>
            <td class="desktop-only"><?= $row['npm']; ?></td>
            <td class="text-center">
                <span class="badge badge-light-primary fs-7 fw-bold">Izin</span>
            </td>
            <td class="desktop-only">
                <?= $row['keterangan']; ?>
            </td>
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
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
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
            <td class="desktop-only"><i class="las la-minus la-3x"></i></td>
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