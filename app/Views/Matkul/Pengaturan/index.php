<?= $this->extend('Matkul/LayoutDetail/index'); ?>

<?= $this->section('boxBawah'); ?>
<!--begin::Basic info-->
<div class="card mb-5 mb-xl-10">
    <!--begin::Card header-->
    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
        data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
        <!--begin::Card title-->
        <div class="card-title m-0">
            <h3 class="fw-bold m-0">Detail Profil</h3>
        </div>
        <!--end::Card title-->
    </div>
    <!--begin::Card header-->
    <!--begin::Content-->
    <div id="kt_account_settings_profile_details" class="collapse show">
        <!--begin::Form-->
        <form id="formDetailProfil" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
            <!--begin::Card body-->
            <div class="card-body border-top p-9">
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label fw-semibold fs-6">Foto Mata Kuliah</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8">
                        <!--begin::Image input-->
                        <div class="image-input image-input-outline <?= ($matkul->image == null) ? 'image-input-empty' : ''; ?>"
                            data-kt-image-input="true"
                            style="background-image: url('/assets/media/svg/avatars/abstract-5.svg')">
                            <!--begin::Preview existing avatar-->
                            <?php if($matkul->image != null) : ?>
                            <div class="image-input-wrapper w-125px h-125px"
                                style="background-image: url(/assets/images/matkul/<?= $matkul->image;?>)">
                            </div>
                            <?php else : ?>
                            <div class="image-input-wrapper w-125px h-125px" style="background-image: none"></div>
                            <?php endif; ?>
                            <!--end::Preview existing avatar-->
                            <!--begin::Label-->
                            <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="change" data-bs-toggle="tooltip" data-kt-initialized="1">
                                <i class="bi bi-pencil-fill fs-7"></i>
                                <!--begin::Inputs-->
                                <input type="file" class="is-invalid" name="image_matkul" id="image_matkul"
                                    accept=".png, .jpg, .jpeg">
                                <input type="hidden" name="avatar_remove">
                                <!--end::Inputs-->
                            </label>
                            <!--end::Label-->
                            <!--begin::Cancel-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Cancel-->
                            <!--begin::Remove-->
                            <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
                                data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-kt-initialized="1">
                                <i class="bi bi-x fs-2"></i>
                            </span>
                            <!--end::Remove-->
                        </div>
                        <!--end::Image input-->
                        <!--begin::Hint-->
                        <div class="form-text">Allowed file types: png, jpg, jpeg.</div>
                        <div class="form-text" style="color: red;" id="image_matkul-feedback"></div>
                        <!--end::Hint-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Nama Mata Kuliah</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                        <input type="text" name="nama" id="nama" class="form-control form-control-lg form-control-solid"
                            placeholder="Nama Mata Kuliah" value="<?= $matkul->nama; ?>" autocomplete="off">
                        <div class="fv-plugins-message-container invalid-feedback" id="nama-feedback"></div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kode Mata Kuliah</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                        <input type="text" name="kode" id="kode" class="form-control form-control-lg form-control-solid"
                            placeholder="Kode Mata Kuliah" value="<?= $matkul->kode; ?>" autocomplete="off">
                        <div class="fv-plugins-message-container invalid-feedback" id="kode-feedback"></div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="row mb-6">
                    <!--begin::Label-->
                    <label class="col-lg-4 col-form-label required fw-semibold fs-6">Kelas</label>
                    <!--end::Label-->
                    <!--begin::Col-->
                    <div class="col-lg-8 fv-row fv-plugins-icon-container">
                        <input type="text" name="kelas" id="kelas" class="form-control form-control-lg form-control-solid"
                            placeholder="Kelas Mata Kuliah" value="<?= $matkul->kelas; ?>" autocomplete="off">
                        <div class="fv-plugins-message-container invalid-feedback" id="kelas-feedback"></div>
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Input group-->
            </div>
            <!--end::Card body-->
            <!--begin::Actions-->
            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <button type="button" class="btn btn-primary" id="btnSimpanMatkul">Simpan</button>
            </div>
            <!--end::Actions-->
        </form>
        <!--end::Form-->
    </div>
    <!--end::Content-->
</div>
<!--end::Basic info-->

<!-- begin::Script -->
<script type="text/javascript">
    let id = <?= json_encode($matkul->id); ?>
</script>
<script src="<?= base_url(); ?>/assets/ajax/ajaxMatkul.js"></script>
<!-- end::Script -->

<?= $this->endSection(); ?>