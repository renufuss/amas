const base_url = window.location.origin;


// ==================================================================
// For Dosen

function datamatkul() {
  $.ajax({
      type: "get",
      url: base_url + "/matkul/table",
      dataType: "json",
      success: function (response) {
          $("#table").html(response.data);
      },
      error: function (xhr, thrownError) {
        alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      },
    });
}

// begin::btnAdd (Add Matkul)
$('#btnAdd').click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/matkul/add",
    data: {
      nama: $('#nama').val(),
      kode: $('#kode').val(),
      kelas: $('#kelas').val(),
    },
    dataType: "json",
    beforeSend: function () {
      $("#btnAdd").html(`
              <div class="spinner-border text-primary m-1" role="status">
              <span class="sr-only">Loading...</span>
              </div>
              `);
      $("#btnAdd").prop('disabled', true);
    },
    complete: function () {
      $("#btnAdd").html(`Simpan`);
      $("#btnAdd").prop('disabled', false);
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

      if (response.sukses) {
        Object.entries(form).forEach(entry => {
          const [key, value] = entry;
          $(`#${key}`).val('');
        });
        toastr.success(response.sukses, "Sukses");
        datamatkul();
      }

    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
// end::btnAdd

// begin::Delete
function deleteMatkul(id, nama) {
  Swal.fire({
    html: `Apakah kamu yakin ingin menghapus ${nama} ?`,
    icon: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    confirmButtonText: "Iya, Hapus",
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: 'btn btn-danger'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: base_url + "/matkul/delete",
        data: {id},
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
          if(!response.error){
            toastr.success(response.sukses, "Sukses");
            datamatkul();
          }else{
            toastr.error(response.error, "Error");
          }
        }
      });
    } 
  });
}
// end::Delete

// begin::Edit
$('#btnSimpanMatkul').click(function (e) { 
  e.preventDefault();
  var form = $("#formDetailProfil")[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: base_url + "/matkul/edit/"+id,
    data: formData,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      $("#btnSimpanMatkul").prop("disabled", true);
      $("#btnSimpanMatkul").html(`
      <div class="spinner-border text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
      </div>`);
    },
    complete: function () {
      $("#btnSimpanMatkul").prop("disabled", false);
      $("#btnSimpanMatkul").html("Simpan");
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
        image_matkul,
      };
      Object.entries(form).forEach(entry => {
        const [key, value] = entry;
        $(`#${key}`).removeClass('is-invalid');
        $(`#${key}-feedback`).html('');
      });

      console.log(response);

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
// end::Edit

// detail
function tableMahasiswa(id){
  $.ajax({
    type: "post",
    url: base_url + "/matkul/mahasiswa/table",
    data: {
      id:id,
    },
    dataType: "json",
    success: function (response) {
        $("#table-mahasiswa").html(response.data);
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function tableAgenda(id){
  $.ajax({
    type: "post",
    url: base_url + "/matkul/agenda/table",
    data: {
      id:id,
    },
    dataType: "json",
    success: function (response) {
        $("#table-agenda").html(response.data);
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

$('#btnSimpanAgenda').click(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/matkul/agenda/simpan",
    data: {
      id_matkul : idMatkul,
      name : $('#name').val(),
      jam_masuk : $('#jam_masuk').val(),
      jam_telat : $('#jam_telat').val(),
      jam_selesai : $('#jam_selesai').val(),
    },
    dataType: "json",
    beforeSend: function () {
      $("#btnSimpanAgenda").html(`
              <div class="spinner-border text-primary m-1" role="status">
              <span class="sr-only">Loading...</span>
              </div>
              `);
      $("#btnSimpanAgenda").prop('disabled', true);
    },
    complete: function () {
      $("#btnSimpanAgenda").html(`Simpan`);
      $("#btnSimpanAgenda").prop('disabled', false);
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
        name,
        jam_masuk,
        jam_telat,
        jam_selesai,
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
        Object.entries(form).forEach(entry => {
          const [key, value] = entry;
          $(`#${key}`).val('');
        });
        toastr.success(response.sukses, "Sukses");
        tableAgenda(idMatkul);
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});

function statusPresent(){
  $.ajax({
    type: "post",
    url: base_url + "/matkul/qr",
    data: {id},
    dataType: "json",
    success: function (response) {
      $('#izin').html(response.izin);
      $('#terlambat').html(response.terlambat);
      $('#hadir').html(response.hadir);
      $('#belumAbsen').html(response.belum_absen);
    }
  });
}

// =================================================================
// For Mahasiswa

function tableListMatkul(){
  $.ajax({
    type: "get",
    url: base_url + "/matkul/list/table",
    dataType: "json",
    success: function (response) {
        $("#table").html(response.data);
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function joinMatkul(id,nama){
  Swal.fire({
    html: `Apakah kamu yakin ingin bergabung dengan ${nama} ?`,
    icon: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    confirmButtonText: "Iya, Gabung",
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: 'btn btn-danger'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: base_url + "/matkul/join",
        data: {id},
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
          if(!response.error){
            toastr.success(response.sukses, "Sukses");
            tableListMatkul();
          }else{
            toastr.error(response.error, "Error");
          }
        }
      });
    } 
  });
}

function tableMatkulSaya(){
  $.ajax({
    type: "get",
    url: base_url + "/matkul/saya/table",
    dataType: "json",
    success: function (response) {
        $("#table").html(response.data);
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}

function hapusJoin(id,nama){
  Swal.fire({
    html: `Apakah kamu yakin ingin keluar dari ${nama} ?`,
    icon: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    confirmButtonText: "Iya, Keluar",
    cancelButtonText: 'Batal',
    reverseButtons: true,
    customClass: {
      confirmButton: "btn btn-primary",
      cancelButton: 'btn btn-danger'
    }
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        type: "post",
        url: base_url + "/matkul/keluar",
        data: {id},
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
          if(!response.error){
            toastr.success(response.sukses, "Sukses");
            tableMatkulSaya();
          }else{
            toastr.error(response.error, "Error");
          }
        }
      });
    } 
  });
}

