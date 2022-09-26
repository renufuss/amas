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
    success: function (response) {
      $("#btnAdd").html(`Simpan`);
      $("#btnAdd").prop('disabled', false);

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
            console.log(response.id);
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

// begin::Table
// Table Pengguna
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