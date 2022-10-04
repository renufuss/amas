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