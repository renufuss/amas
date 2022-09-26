const base_url = window.location.origin;

// begin::Button
    // begin::btnAdd (Open Add Pengguna Modal)
    $('#btnAdd').click(function (e) { 
        e.preventDefault();
        $.ajax({
          type: "post",
          url: base_url + "/pengguna/add",
          data: {
            username : $('#username').val(),
            email : $('#email').val(),
            first_name : $('#first_name').val(),
            last_name : $('#last_name').val(),
            role : $('#role').val(),
          },
          dataType: "json",
          beforeSend: function () {
            $("#btnAdd").html(`
              <div class="spinner-border text-primary m-1" role="status">
              <span class="sr-only">Loading...</span>
              </div>
              `);
          },
          success: function (response) {
            console.log(response.pesan);
            $("#btnAdd").html(`Simpan`);
          },    
          error: function (xhr, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          },
        });
    });
    // end::btnAdd

// end::Button