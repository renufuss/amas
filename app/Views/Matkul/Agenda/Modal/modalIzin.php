<div class="modal fade" id="modalIzin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="modalIzinLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalIzinLabel">Form Izin | <?= $agenda->name; ?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <!-- end modalheader -->
            <div class="modal-body">
                <!-- Alert Gagal Update-->
                <div class="alert alert-danger hide" id="alertGagalIzin"></div>
                <div class="mb-3">
                <form id="formIzin">
                    <?= csrf_field(); ?>
                    <!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Keterangan</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan keterangan izin"
									name="keterangan" id="keterangan" autocomplete="off" />
								<div class="invalid-feedback" id="keterangan-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
                    <label for="bukti" class="form-label">Bukti</label>
                    <input type="file" class="form-control" id="bukti" name="bukti" autocomplete="off" accept=".png, .jpg, .jpeg">
                    <div class="invalid-feedback" id="bukti-feedback"></div>
                    <input type="hidden" name="idAgenda" id="idAgenda" value="<?= $agenda->id; ?>">

                </form>
                </div>
            </div>
            <!-- end modalbody -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="btnSimpanIzin">Ajukan Izin</button>
            </div>
            <!-- end modalfooter -->
        </div>
    </div>
</div>

<script>
    $('#btnSimpanIzin').click(function (e) { 
  e.preventDefault();
  var form = $("#formIzin")[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: base_url + "/agenda/izin/save",
    data: formData,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      $("#btnSimpanIzin").prop("disabled", true);
      $("#btnSimpanIzin").html(`
      <div class="spinner-border text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
      </div>`);
    },
    complete: function () {
      $("#btnSimpanIzin").prop("disabled", false);
      $("#btnSimpanIzin").html("Simpan");
    },
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

      // Remove Feedback
      form = {
        keterangan,
        bukti,
      };
      Object.entries(form).forEach(entry => {
        const [key, value] = entry;
        $(`#${key}`).removeClass('is-invalid');
        $(`#${key}-feedback`).html('');
      });


      if (response.error) {
        // Add Feedback
        Object.entries(response.error).forEach(entry => {
          const [key, value] = entry;
          $(`#${key}`).addClass('is-invalid');
          $(`#${key}-feedback`).html(value);
        });

        toastr.error(response.errormsg, "Error");
      }

      if (response.sukses) {
        toastr.success(response.sukses, "Sukses");
        setTimeout(function () {
          location.reload();
        }, 1200);
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
</script>