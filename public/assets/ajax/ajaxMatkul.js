const base_url = window.location.origin;

$(document).ready(function () {
  datamatkul();
});


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