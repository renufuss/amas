<?= $this->extend('Auth/Layout/index'); ?>


<?= $this->section('main'); ?>
<!--begin::Root-->
<div class="d-flex flex-column flex-root" id="kt_app_root">
    <!--begin::Authentication - Sign-in -->
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <!--begin::Logo-->
        <a href="../../demo1/dist/index.html" class="d-block d-lg-none mx-auto py-20">
            <img alt="Logo" src="assets/media/logos/default.svg" class="theme-light-show h-25px" />
            <img alt="Logo" src="assets/media/logos/default-dark.svg" class="theme-dark-show h-25px" />
        </a>
        <!--end::Logo-->
        <!--begin::Aside-->
        <div class="d-flex flex-column flex-column-fluid flex-center w-lg-50 p-10">
            <!--begin::Wrapper-->
            <div class="d-flex justify-content-between flex-column-fluid flex-column w-100 mw-450px">
                <!--begin::Header-->
                <div class="d-flex flex-stack py-2">
                    <!--begin::Back link-->
                    <div class="me-2"></div>
                    <!--end::Back link-->
                    <!--begin::Sign Up link-->
                    <div class="m-0">
                        <span class="text-gray-400 fw-bold fs-5 me-2" data-kt-translate="sign-in-head-desc">Belum mempunyai akun?</span>
                        <a href="<?= base_url('register'); ?>"
                            class="link-primary fw-bold fs-5" data-kt-translate="sign-in-head-link">Daftar</a>
                    </div>
                    <!--end::Sign Up link=-->
                </div>
                <!--end::Header-->
                <!--begin::Body-->
                <div class="py-20">
                    <!--begin::Form-->
                    <?php include('Form/form.php'); ?>
                    <!--end::Form-->
                </div>
                <!--end::Body-->

<?= $this->endSection(); ?>