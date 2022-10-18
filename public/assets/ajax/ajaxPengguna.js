const base_url = window.location.origin;

$(document).ready(function () {
  table();
});

// begin::btnAdd (Add Pengguna)
$('#btnAdd').click(function (e) {
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/pengguna/add",
    data: {
      username: $('#username').val(),
      email: $('#email').val(),
      first_name: $('#first_name').val(),
      last_name: $('#last_name').val(),
      role: $('#role').val(),
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
        username,
        email,
        first_name,
        last_name,
        role
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
        table();
      }

    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
});
// end::btnAdd

// begin::Delete
function deletePengguna(id, username) {
  Swal.fire({
    html: `Apakah kamu yakin ingin menghapus ${username} ?`,
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
        url: base_url + "/pengguna/delete",
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
            table();
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
$('#btnSimpanProfil').click(function (e) { 
  e.preventDefault();
  var form = $("#formDetailProfil")[0]; // You need to use standard javascript object here
  var formData = new FormData(form);
  $.ajax({
    type: "post",
    url: base_url + "/pengguna/edit/"+username,
    data: formData,
    dataType: "json",
    contentType: false,
    processData: false,
    cache: false,
    beforeSend: function () {
      $("#btnSimpanProfil").prop("disabled", true);
      $("#btnSimpanProfil").html(`
      <div class="spinner-border text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
      </div>`);
    },
    complete: function () {
      $("#btnSimpanProfil").prop("disabled", false);
      $("#btnSimpanProfil").html("Simpan");
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
        first_name,
        last_name,
        role,
        image_profile,
        npm,
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
// end::Edit

// begin::Table
function table() {
  $.ajax({
    type: "get",
    url: base_url + "/pengguna/table",
    dataType: "json",
    success: function (response) {
      if (response.table) {
        $("#table").html(response.table);
      }
    },
    error: function (xhr, thrownError) {
      alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
    },
  });
}
// end::Table

// begin::Button Edit

// Informasi Login
$('#btnUbahLogin').click(function (e) { 
  e.preventDefault();
  $('#info_login_edit').removeClass('d-none');
  $('#email_address').addClass('d-none');
  $('#btn_login_edit').addClass('d-none');
  $('#username_label').addClass('d-none');
});

$('#btnCancelUbahLogin').click(function (e) { 
  e.preventDefault();
  $('#info_login_edit').addClass('d-none');
  $('#btn_login_edit').removeClass('d-none');
  $('#email_address').removeClass('d-none');
  $('#username_label').removeClass('d-none');
});

$('#btnSimpanLogin').click(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/pengguna/login/"+username,
    data: {
      username : $('#username').val(),
      email: $('#email').val(),
    },
    dataType: "json",
    beforeSend: function () {
      $("#btnSimpanLogin").prop("disabled", true);
      $("#btnSimpanLogin").html(`
      <div class="spinner-border text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
      </div>`);
    },
    complete: function () {
      $("#btnSimpanLogin").prop("disabled", false);
      $("#btnSimpanLogin").html("Simpan");
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
        username,
        email,
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
          window.location.replace(base_url + "/pengguna/pengaturan/" + $('#username').val());
        }, 1200);
      }
    }
  });
});

// Password
$('#btnResetPassword').click(function (e) { 
  e.preventDefault();
  Swal.fire({
    html: `Apakah kamu yakin ingin reset password ${username} ?`,
    icon: "warning",
    buttonsStyling: false,
    showCancelButton: true,
    confirmButtonText: "Iya, Reset",
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
        url: base_url + "/pengguna/reset/" + username,
        data: {username},
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
          }else{
            toastr.error(response.error, "Error");
          }
        }
      });
    } 
  });
});

// end::Button Edit

// Ganti Password Pengguna
$('#btnGantiPass').click(function (e) { 
  e.preventDefault();
  $('#ganti_pass').removeClass('d-none');
  $('#password').addClass('d-none');
  $('#btnGantiPass').addClass('d-none');
});

$('#btnCancelPass').click(function (e) { 
  e.preventDefault();
  $('#ganti_pass').addClass('d-none');
  $('#password').removeClass('d-none');
  $('#btnGantiPass').removeClass('d-none');
});

$('#btnSimpanPass').click(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/profil/savepass",
    data: {
      passwordLama : $('#passwordLama').val(),
      passwordBaru : $('#passwordBaru').val(),
      confirmPassword : $('#confirmPassword').val(),
    },
    dataType: "json",
    beforeSend: function () {
      $("#btnSimpanPass").prop("disabled", true);
      $("#btnSimpanPass").html(`
      <div class="spinner-border text-primary m-1" role="status">
      <span class="sr-only">Loading...</span>
      </div>`);
    },
    complete: function () {
      $("#btnSimpanPass").prop("disabled", false);
      $("#btnSimpanPass").html("Simpan");
    },
    success: function (response) {
      console.log(response);
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

      form = {
        passwordLama,
        passwordBaru,
        confirmPassword,
      }
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
    }
  });
});