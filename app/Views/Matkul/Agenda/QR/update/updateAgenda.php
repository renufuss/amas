 <!--begin::Update Time-->
 <div class="row" id="detailAgenda">
     <div class="col-lg-4 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Agenda</div>
             <div class="fw-semibold text-gray-600"><?= $agenda->name; ?></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Masuk</div>
             <div class="fw-semibold text-gray-600"><?= $agenda->jam_masuk; ?></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-3">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Telat</div>
             <div class="fw-semibold text-gray-600"><?= $agenda->jam_telat; ?></div>
         </div>
     </div>
     <div class="col-lg-2 col-6 mb-5">
         <div class="text-center">
             <div class="fs-6 fw-bold mb-1">Jam Selesai</div>
             <div class="fw-semibold text-gray-600"><?= $agenda->jam_selesai; ?></div>
         </div>
     </div>
    
     <div class="col-lg-2 text-center col-12 mb-3">
         <!--begin::Action-->
         <div id="btn_login_edit text-end" class="ms-auto">
             <button class="btn btn-light btn-active-light-primary" id="btnUbahAgenda">Ubah Agenda</button>
         </div>
         <!--end::Action-->
     </div>
</div>
 <!--end::Update Time-->

 <?php include('form/formUpdateAgenda.php'); ?>