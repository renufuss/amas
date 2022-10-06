		<div class="modal fade" id="modalMatkul" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			role="dialog" aria-labelledby="modalMatkulLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalMatkulLabel">Tambah Mata Kuliah</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						</button>
					</div>
					<!-- end modalheader -->
					<div class="modal-body">
						<!-- Alert Gagal Update-->
						<div class="alert alert-danger hide" id="alertGagalMatkul"></div>
						<!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Nama Mata Kuliah</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan nama matkul"
									name="nama" id="nama" autocomplete="off" value="<?= ($matkul!=null) ? $matkul->nama : '';?>" />
								<div class="invalid-feedback" id="nama-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row g-9">
							<!-- begin::col -->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Kode Mata Kuliah</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan kode matkul"
									name="kode" id="kode" autocomplete="off" value="<?= ($matkul!=null) ? $matkul->kode : '';?>" />
									<div class="invalid-feedback" id="kode-feedback"></div>
							</div>
							<!-- end::col -->
							<!-- begin::col -->
							<div class="col-md-6 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Kelas</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid"
									placeholder="Masukkan kelas" name="kelas" id="kelas" autocomplete="off" value="<?= ($matkul!=null) ? $matkul->kelas : '';?>" />
									<div class="invalid-feedback" id="kelas-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
					</div>
					<!-- end modalbody -->
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btnSimpan">Simpan</button>
					</div>
					<!-- end modalfooter -->
				</div>
			</div>
		</div>

    <input type="hidden" name="id" id="id" value="<?= ($matkul!=null) ? $matkul->id : '';?>">
		<script>
			// begin::btnAdd (Add Matkul)
$('#btnSimpan').click(function (e) {
  e.preventDefault();
 
    $.ajax({
    type: "post",
    url: base_url + "/matkul/save",
    data: {
	   id :$('#id').val(),
      nama: $('#nama').val(),
      kode: $('#kode').val(),
      kelas: $('#kelas').val(),
    },
    dataType: "json",
    beforeSend: function () {
      $("#btnSimpan").html(`
              <div class="spinner-border text-primary m-1" role="status">
              <span class="sr-only">Loading...</span>
              </div>
              `);
      $("#btnSimpan").prop('disabled', true);
    },
    complete: function () {
      $("#btnSimpan").html(`Simpan`);
      $("#btnSimpan").prop('disabled', false);
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
        nama,
        kode,
        kelas,
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
      
      if(response.errorupdate){
        toastr.error(response.errorupdate, "Error");
      }

      if (response.sukses) {
        Object.entries(form).forEach(entry => {
          const [key, value] = entry;
          $(`#${key}`).val('');
        });
        toastr.success(response.sukses, "Sukses");

        if(response.refresh == true) {
          setTimeout(function () {
          location.reload();
          }, 700);
        }
        datamatkul();
      }

    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
// end::btnAdd
		</script>