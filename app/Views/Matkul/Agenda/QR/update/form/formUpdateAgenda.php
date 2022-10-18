 <!--begin::Update Time-->
 <div class="row d-none" id="formAgenda">
     <div class="col-lg-4 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Agenda</div>
             <input type="text" name="name" id="name"
                 class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off"
                 value="<?= $agenda->name; ?>">
                 <div class="invalid-feedback" id="name-feedback"></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Masuk</div>
             <input type="text" name="jam_masuk" id="jam_masuk"
                 class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off"
                 value="<?= $agenda->jam_masuk; ?>">
                 <div class="invalid-feedback" id="jam_masuk-feedback"></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Telat</div>
             <input type="text" name="jam_telat" id="jam_telat"
                 class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off"
                 value="<?= $agenda->jam_telat; ?>">
                 <div class="invalid-feedback" id="jam_telat-feedback"></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-5">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Selesai</div>
             <input type="text" name="jam_selesai" id="jam_selesai"
                 class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" autocomplete="off"
                 value="<?= $agenda->jam_selesai; ?>">
                 <div class="invalid-feedback" id="jam_selesai-feedback"></div>
         </div>
     </div>

     <div class="col-lg-2 text-center col-12 mb-3">
         <!--begin::Action-->
         <div id="btn_login_edit text-end" class="ms-auto">
             <button class="btn btn-primary btn-active-light-primary" id="btnSimpanUbahAgenda">Simpan</button>
         </div>
         <!--end::Action-->
         <br>
         <!--begin::Action-->
         <div id="btn_login_edit text-end" class="ms-auto">
             <button class="btn btn-light btn-active-light-primary" id="cancelSimpanAgenda">Cancel</button>
         </div>
         <!--end::Action-->
     </div>
 </div>
 <!--end::Update Time-->

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
             }, ]
         });
         $("#jam_telat").flatpickr({
             enableTime: true,
             dateFormat: "Y-m-d H:i",
             disable: [{
                 from: "1000-01-01",
                 to: "<?= $minJamMasuk; ?>"
             }, ]
         });
         $("#jam_selesai").flatpickr({
             enableTime: true,
             dateFormat: "Y-m-d H:i",
             disable: [{
                 from: "1000-01-01",
                 to: "<?= $minJamMasuk; ?>"
             }, ]
         });
     });
 </script>