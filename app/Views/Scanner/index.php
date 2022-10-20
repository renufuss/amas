<?= $this->extend('Layout/index'); ?>


<?= $this->section('content'); ?>
<style>
    @media (max-width: 480px) {
        #preview {
            width: 300px;
            height: 500px;
        }
    }
</style>

<!--begin::Card-->
<div class="card mb-5 mb-xl-8">
    <!--begin::Card Header-->
    <div class="card-header border-0 pt-5">
        <h2>Scan QR Code</h2>
    </div>
    <!--end::Card Header-->
    <!--begin::Card Body-->
    <div class="card-body py-3">
        <!--begin::Camera container-->
        <video id="preview"></video>
        <!--end::Camera container-->
        <div class="btn-group btn-group-toggle mb-5 mobile-only" data-toggle="buttons">
            <label class="btn btn-primary active">
                <input type="radio" name="options" value="2" autocomplete="off" checked> Back Camera
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" value="1" autocomplete="off"> Front Camera
            </label>
        </div>
    </div>
    <!--end::Card Body-->
</div>
<!--end::Card-->

<script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
<script type="text/javascript">
    const base_url = window.location.origin;
    var scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        scanPeriod: 5,
        mirror: false
    });
    scanner.addListener('scan', function (content) {
        // alert(content);
        // window.location.href = base_url +'/present/agenda/' + content;
        $.ajax({
            type: "post",
            url: base_url + "/scanner/present",
            data: {
                id : content,
            },
            dataType: "json",
            success: function (response) {
            toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": true,
            "progressBar": true,
            "positionClass": "toastr-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "1500",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
            if(response.sukses){
            toastr.success(response.sukses, "Sukses");
            setTimeout(function () {
                window.location.href = base_url +'/thankyou/' + response.idAgenda + '/' + response.idMahasiswaAgenda;
            }, 1200);
            }

            if(response.error){
                toastr.error(response.error, "Error");
            }
            },error: function (xhr, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            },
        });
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[1]);
            $('[name="options"]').on('change', function () {
                if ($(this).val() == 1) {
                    if (cameras[0] != "") {
                        scanner.start(cameras[0]);
                    } else {
                        alert('No Front camera found!');
                    }
                } else if ($(this).val() == 2) {
                    if (cameras[1] != "") {
                        scanner.start(cameras[1]);
                    } else {
                        alert('No Back camera found!');
                    }
                }
            });
        } else {
            console.error('No cameras found.');
            alert('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
        alert(e);
    });
</script>


<?= $this->endSection(); ?>