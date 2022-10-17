		<div class="modal fade" id="modalAgenda" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			role="dialog" aria-labelledby="modalAgendaLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalAgendaLabel">Tambah Agenda</h5>
						<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
						</button>
					</div>
					<!-- end modalheader -->
					<div class="modal-body">
						<!-- Alert Gagal Update-->
						<div class="alert alert-danger hide" id="alertGagalAgenda"></div>
						<!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Nama Mata Kuliah</span>
								</label>
								<!--end::Label-->
								<input type="text" class="form-control form-control-solid" placeholder="Masukkan nama agenda"
									name="name" id="name" autocomplete="off" />
								<div class="invalid-feedback" id="name-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Jam Masuk</span>
								</label>
								<!--end::Label-->
								<input class="form-control form-control-solid" placeholder="Pilih jam masuk" id="jam_masuk" />
								<div class="invalid-feedback" id="jam_masuk-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Jam Telat</span>
								</label>
								<!--end::Label-->
								<input class="form-control form-control-solid" placeholder="Pilih jam telat" id="jam_telat" />
								<div class="invalid-feedback" id="jam_telat-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
						<!--begin::Input group-->
						<div class="row g-9 mb-8">
							<!-- begin::col -->
							<div class="col-md-12 fv-row">
								<!--begin::Label-->
								<label class="d-flex align-items-center fs-6 fw-semibold mb-2">
									<span class="required">Jam Selesai</span>
								</label>
								<!--end::Label-->
								<input class="form-control form-control-solid" placeholder="Pilih jam selesai"
									id="jam_selesai" />
								<div class="invalid-feedback" id="jam_selesai-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
					</div>
					<!-- end modalbody -->
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btnSimpanAgenda">Simpan</button>
					</div>
					<!-- end modalfooter -->
				</div>
			</div>
		</div>

		<!-- Tanggal -->
		<?php
        $date = date('Y-m-d H:i');
		$minJamMasuk = strtotime('-1 day', strtotime($date));
		$minJamMasuk = date('Y-m-d H:i', $minJamMasuk);
		?>

		<script>
			$(document).ready(function () {
				$("#jam_masuk").flatpickr({
					enableTime: true,
					dateFormat: "Y-m-d H:i",
					disable: [{
							from: "1000-01-01",
							to: "<?= $minJamMasuk; ?>"
						},
					]
				});
				$("#jam_telat").flatpickr({
					enableTime: true,
					dateFormat: "Y-m-d H:i",
					disable: [{
							from: "1000-01-01",
							to: "<?= $minJamMasuk; ?>"
						},
					]
				});
				$("#jam_selesai").flatpickr({
					enableTime: true,
					dateFormat: "Y-m-d H:i",
					disable: [{
							from: "1000-01-01",
							to: "<?= $minJamMasuk; ?>"
						},
					]
				});
			});
		</script>