<form class="form w-100" action="<?= url_to('register') ?>" method="post">
    <?= csrf_field() ?>
    <!--begin::Heading-->
    <div class="text-start mb-10">
        <!--begin::Title-->
        <h1 class="text-dark mb-3 fs-3x">Daftar</h1>
        <!--end::Title-->
        <!--begin::Text-->
        <div class="text-gray-400 fw-semibold fs-7">Kemudahan melakukan presensi menggunakan teknologi QR Code</div>
        <!--end::Link-->
    </div>
    <?= view('Myth\Auth\Views\_message_block') ?>
    <!--end::Heading-->
    <!--begin::Input group-->
    <div class="row fv-row mb-7">
        <!--begin::Col-->
        <div class="col-xl-6 mb-5">
            <input
                class="form-control form-control-lg form-control-solid <?php if (session('errors.first_name')) : ?>is-invalid<?php endif ?>"
                type="text" placeholder="Nama Depan" name="first_name" autocomplete="off" value="<?= old('first_name') ?>" />
            <div class="invalid-feedback">
                <?= session('errors.first_name') ?>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-6">
            <input
                class="form-control form-control-lg form-control-solid <?php if (session('errors.last_name')) : ?>is-invalid<?php endif ?>"
                type="text" placeholder="Nama Belakang" name="last_name" autocomplete="off" value="<?= old('last_name') ?>" />
            <div class="invalid-feedback">
                <?= session('errors.last_name') ?>
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" type="text" placeholder="Username" name="username" autocomplete="off" value="<?= old('username') ?>" />
            <div class="invalid-feedback">
				<?= session('errors.username') ?>
			</div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <input class="form-control form-control-lg form-control-solid <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>"
            type="email" placeholder="Email" name="email" autocomplete="off" value="<?= old('email') ?>" />
            <div class="invalid-feedback">
				<?= session('errors.email') ?>
			</div>
    </div>
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="fv-row mb-10" data-kt-password-meter="true">
        <!--begin::Wrapper-->
        <div class="mb-1">
            <!--begin::Input wrapper-->
            <div class="position-relative mb-3">
                <input
                    class="form-control form-control-lg form-control-solid <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>"
                    type="password" placeholder="Password" name="password" autocomplete="off" />
                <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                    data-kt-password-meter-control="visibility">
                    <i class="bi bi-eye-slash fs-2"></i>
                    <i class="bi bi-eye fs-2 d-none"></i>
                </span>
            </div>
            <!--end::Input wrapper-->
            <!--begin::Meter-->
            <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
            </div>
            <!--end::Meter-->
        </div>
        <!--end::Wrapper-->
        <!--begin::Hint-->
        <div class="text-muted">Gunakan 8 karakter atau lebih dengan campuran huruf, angka &amp; simbol.</div>
        <!--end::Hint-->
    </div>
    <!--end::Input group=-->
    <!--begin::Input group-->
    <div class="fv-row mb-10">
        <input
            class="form-control form-control-lg form-control-solid <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>"
            type="password" placeholder="Konfirmasi Password" name="pass_confirm" autocomplete="off" />
    </div>
    <!--end::Input group-->
    <!--begin::Actions-->
    <div class="d-flex flex-stack">
        <!--begin::Submit-->
        <button type="submit" class="btn btn-primary">Daftar</button>
        <!--end::Submit-->
    </div>
    <!--end::Actions-->
</form>