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
									name="nama" id="nama" autocomplete="off" />
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
									name="kode" id="kode" autocomplete="off" />
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
									placeholder="Masukkan kelas" name="kelas" id="kelas" autocomplete="off" />
									<div class="invalid-feedback" id="kelas-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
					</div>
					<!-- end modalbody -->
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btnAdd">Simpan</button>
					</div>
					<!-- end modalfooter -->
				</div>
			</div>
		</div>

		<div class="modal fade" id="modalUpMatkul" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
			role="dialog" aria-labelledby="modalUpMatkulLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalUpMatkulLabel">Edit Mata Kuliah</h5>
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
									name="nama" id="nama" autocomplete="off" />
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
									name="kode" id="kode" autocomplete="off" />
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
									placeholder="Masukkan kelas" name="kelas" id="kelas" autocomplete="off" />
									<div class="invalid-feedback" id="kelas-feedback"></div>
							</div>
							<!-- end::col -->
						</div>
						<!--end::Input group-->
					</div>
					<!-- end modalbody -->
					<div class="modal-footer">
						<button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="btnAdd">Simpan</button>
					</div>
					<!-- end modalfooter -->
				</div>
			</div>
		</div>