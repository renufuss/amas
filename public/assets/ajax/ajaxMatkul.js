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



$('#btnTambahMatkul').click(function (e) { 
  e.preventDefault();
  $.ajax({
    type: "post",
    url: base_url + "/matkul/modal",
    data: {
      id: null
    },
    dataType: "json",
    success: function (response) {
      if (response.sukses) {
        $('.viewModal').html(response.sukses).show()
        $('#modalMatkul').modal('show');
      }
      
    }
  });
});

//begin::Edit
function edit(id) {
  $.ajax({
    type: "post",
    url: base_url + "/matkul/modal",
    data: {
      id: id
    },
    dataType: "json",
    success: function (response) {
      if (response.sukses) {
        $('.viewModal').html(response.sukses).show()
        $('#modalMatkul').modal('show');
      }
      
    }
  });
  
}
//end::Edit

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
